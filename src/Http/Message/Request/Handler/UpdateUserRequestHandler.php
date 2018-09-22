<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Assert\AssertionFailedException;
use Learn\Database\PdoConnection;
use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Log\ContextCreator;
use Learn\Log\LoggerAwareTrait;
use Learn\Log\LoggerInterface;
use Learn\Model\Value\FirstName;
use Learn\Model\Value\LastName;
use Learn\Model\Value\UserId;
use Learn\Repository\Exception\ApiException;
use Learn\Repository\Exception\UserNotFoundException;
use Learn\Repository\UserRepository;
use Learn\Repository\UserRepositoryInterface;

class UpdateUserRequestHandler implements RequestHandlerInterface
{
    /** @var PdoConnection */
    private $connection;
    /** @var UserRepository */
    private $repository;

    /**
     * UpdateUserRequestHandler constructor.
     *
     * @param PdoConnection           $connection
     * @param UserRepositoryInterface $repository

     */
    public function __construct($connection, $repository)
    {
        $this->connection = $connection;
        $this->repository = $repository;
    }

    /**
     * @inheritdoc
     * @throws ApiException
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        $this->connection->beginTransaction();

        try {
            $data = $request->getBody();

            if (!array_key_exists('firstName', $data) || !array_key_exists('lastName', $data)) {
                throw new \InvalidArgumentException('Missing one of required field.');
            }

            $id = $request->getRouteParams()[':id'];

            $user = $this->repository->find(UserId::fromString($id));

            $user->setFirstName(new FirstName($data['firstName']));
            $user->setLastName(new LastName($data['lastName']));

            $this->repository->update($user);

            $updatedUser = $this->repository->find(UserId::fromString($id));

            $this->connection->commit();

            return new HttpResponse(200, $updatedUser->toArray());

        } catch (\InvalidArgumentException $ex) {
            $this->connection->rollBack();
            throw new ApiException($ex->getMessage(), 400, $ex);

        } catch (UserNotFoundException $ex) {
            $this->connection->rollBack();
            throw new ApiException($ex->getMessage(), 404, $ex);

        } catch (AssertionFailedException $ex) {
            $this->connection->rollBack();
            throw new ApiException($ex->getMessage(), 400, $ex);

        } catch (\Throwable $ex) {
            $this->connection->rollBack();

            throw $ex;
        }
    }
}