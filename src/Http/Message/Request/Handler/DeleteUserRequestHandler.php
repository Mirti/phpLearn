<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Learn\Database\PdoConnection;
use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Model\Value\UserId;
use Learn\Repository\Exception\ApiException;
use Learn\Repository\Exception\UserNotFoundException;
use Learn\Repository\UserRepository;
use Learn\Repository\UserRepositoryInterface;

class DeleteUserRequestHandler implements RequestHandlerInterface
{
    /** @var PdoConnection */
    private $connection;

    /** @var UserRepository */
    private $repository;

    /**
     * DeleteUserRequestHandler constructor.
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
            $id   = $request->getRouteParams()[':id'];
            $user = $this->repository->find(UserId::fromString($id));

            $this->repository->delete($user);

            $this->connection->commit();

            return new HttpResponse(204);

        } catch (UserNotFoundException $ex) {
            $this->connection->rollBack();
            throw new ApiException($ex->getMessage(), 404, $ex);

        } catch (\Throwable $ex) {
            $this->connection->rollBack();

            throw $ex;
        }
    }
}