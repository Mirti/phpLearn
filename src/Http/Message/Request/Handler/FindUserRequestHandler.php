<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Model\Value\UserId;
use Learn\Repository\Exception\ApiException;
use Learn\Repository\Exception\UserNotFoundException;
use Learn\Repository\UserRepositoryInterface;

class FindUserRequestHandler implements RequestHandlerInterface
{
    /** @var UserRepositoryInterface */
    private $repository;

    /**
     * FindUserRequestHandler constructor.
     *
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritdoc
     * @throws ApiException
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

        $response = new HttpResponse(200, $user->toArray());

        return $response;
    }
}