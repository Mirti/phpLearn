<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Assert\AssertionFailedException;
use Learn\Database\PdoConnection;
use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Log\Logger;
use Learn\Log\LoggerAware;
use Learn\Log\LoggerInterface;
use Learn\Model\User;
use Learn\Model\Value\FirstName;
use Learn\Model\Value\LastName;
use Learn\Model\Value\UserId;
use Learn\Repository\Exception\ApiException;
use Learn\Repository\UserRepositoryInterface;

class AddUserRequestHandler implements RequestHandlerInterface
{
    /** @var PdoConnection */
    private $connection;

    /** @var UserRepositoryInterface */
    private $repository;

    /** @var LoggerInterface */
    private $logger;

    /**
     * AddUserRequestHandler constructor.
     * @param $connection
     * @param $repository
     * @param $loggerConfig
     */
    public function __construct($connection, $repository, $loggerConfig)
    {
        $this->connection = $connection;
        $this->repository = $repository;

        $this->logger = new Logger();

        $loggerAware = new LoggerAware($loggerConfig);
        $loggerAware->setLogger($this->logger);
    }

    /**
     * @inheritdoc
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        $this->connection->beginTransaction();

        try {
            $data                = $request->getBody();
            $additionalArguments = [];

            if (!array_key_exists('firstName', $data) || !array_key_exists('lastName', $data)) {
                throw new \InvalidArgumentException('Missing one of required field.');
            }

            foreach ($data as $key => $value) {
                if ($key != 'firstName' && $key != 'lastName') {
                    $additionalArguments[] = $key;
                }
            }

            if (sizeof($additionalArguments) > 0) {
                $errorMessage = "Too many arguments (" . implode(', ', $additionalArguments) . ")";
                throw new \InvalidArgumentException($errorMessage);
            }

            $id   = UserId::generate();
            $user = new User($id, new FirstName($data['firstName']), new LastName($data['lastName']));

            $this->repository->add($user);
            $createdUser = $this->repository->find($id)->toArray();

            $this->connection->commit();

            return new HttpResponse(201, $createdUser);

        } catch (\InvalidArgumentException $ex) {
            $this->connection->rollBack();

            $context['id']     = $request->getRemoteAddress();
            $context['method'] = $request->getMethod();
            $context['url']    = $request->getUrl();
            $context['code']   = $ex->getCode();
            $context['file']   = $ex->getFile();
            $context['line']   = $ex->getLine();

            $this->logger->warning($ex->getMessage(), $context);

            throw new ApiException($ex->getMessage(), 400, $ex);

        } catch (AssertionFailedException $ex) {
            $this->connection->rollBack();
            throw new ApiException($ex->getMessage(), 400, $ex);
        }
    }
}