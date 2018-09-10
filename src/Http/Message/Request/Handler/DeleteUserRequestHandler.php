<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Repository\UserRepositoryInterface;

class DeleteUserRequestHandler implements RequestHandlerInterface
{

    /** @var */
    private $repository;

    /**
     * DeleteUserRequestHandler constructor.
     * @param UserRepositoryInterface $repository
     */
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritdoc
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        $user = $this->repository->find($request->getRouteParams()[":id"]);

        $this->repository->delete($user);

        return new HttpResponse(204);
    }
}