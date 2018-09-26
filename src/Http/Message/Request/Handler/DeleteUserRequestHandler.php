<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Model\Value\UserId;
use Learn\Repository\Exception\ApiException;
use Learn\Repository\Exception\UserNotFoundException;
use Learn\Repository\UserRepository;

class DeleteUserRequestHandler implements RequestHandlerInterface
{
    /** @var UserRepository */
    private $repository;
    /** @var */
    private $middleware;

    /**
     * DeleteUserRequestHandler constructor.
     * @param $repository
     * @param $middleware
     */
    public function __construct($repository, $middleware)
    {

        $this->repository = $repository;
        $this->middleware = $middleware;
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

        try {
            $userId = UserId::fromString($id);

        } catch (\InvalidArgumentException $ex) {
            throw new ApiException($ex->getMessage(), 400);
        }

        try {
            $user = $this->repository->find($userId);

        } catch (UserNotFoundException $ex) {
            throw new ApiException($ex->getMessage(), 404);
        }

        try {
            $this->repository->delete($user);
            $response = new HttpResponse(204);

        } catch (\Throwable $ex) {
            throw $ex;
        }

        return $response;
    }
}


