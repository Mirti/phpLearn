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

    /**
     * DeleteUserRequestHandler constructor.
     * @param $repository
     */
    public function __construct($repository)
    {

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

        $userId = UserId::fromString($id);

        try {
            $user = $this->repository->find($userId);

        } catch (UserNotFoundException $ex) {
            throw new ApiException($ex->getMessage(), 404);
        }

        $this->repository->delete($user);
        $response = new HttpResponse(204);

        return $response;
    }
}


