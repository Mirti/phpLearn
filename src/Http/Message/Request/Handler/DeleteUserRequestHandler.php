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
     * @throws \Throwable
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        $id = $request->getRouteParams()[':id'];
        if (!isset($id)) {
            throw new ApiException("Can not access User ID", 404);
        }

        $this->connection->beginTransaction();

        try {
            $user = $this->repository->find(UserId::fromString($id));

            $this->repository->delete($user);
            $response = new HttpResponse(204);
            $this->connection->commit();
            return $response;

        } catch (UserNotFoundException $ex) {
            $this->connection->rollBack();
            throw new ApiException($ex->getMessage(), 404);

        } catch (\InvalidArgumentException $ex) {
            $this->connection->rollBack();
            throw new ApiException($ex->getMessage(), 400);

        } catch (\Throwable $ex) {
            $this->connection->rollBack();
            throw $ex;
        }
    }
}


