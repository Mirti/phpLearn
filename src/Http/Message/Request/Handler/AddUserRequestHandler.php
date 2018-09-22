<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Assert\AssertionFailedException;
use Learn\Database\PdoConnection;
use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
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
     *
     * @param PdoConnection           $connection
     * @param UserRepositoryInterface $repository
     * @param LoggerInterface         $logger
     */
    public function __construct(
        PdoConnection $connection,
        UserRepositoryInterface $repository,
        LoggerInterface $logger
    ) {
        $this->connection = $connection;
        $this->repository = $repository;
        $this->logger     = $logger;
    }

    /**
     * @inheritdoc
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        $this->connection->beginTransaction();

        try {
            $data = $request->getBody();

            if (!array_key_exists('firstName', $data) || !array_key_exists('lastName', $data)) {
                throw new \InvalidArgumentException('Missing one of required field.');
            }

            if ($params = array_diff(array_keys($data), ['firstName', 'lastName'])) {
                throw new \InvalidArgumentException('Too many arguments: ' . implode(',', $params), 400);
            }

            $id   = UserId::generate();
            $user = new User($id, new FirstName($data['firstName']), new LastName($data['lastName']));

            $this->repository->add($user);
            $createdUser = $this->repository->find($id)->toArray();

            $this->connection->commit();

            return new HttpResponse(201, $createdUser);

        } catch (\InvalidArgumentException $ex) {
            $this->connection->rollBack();

            throw new ApiException($ex->getMessage(), 400, $ex);

        } catch (AssertionFailedException $ex) {
            $this->connection->rollBack();
            throw new ApiException($ex->getMessage(), 400, $ex);

        } catch (\Throwable $ex) {
            $this->connection->rollBack();

            $this->logger->error('Failed to add new user', ['exception' => $ex->__toString()]);

            throw $ex;
        }
    }
}