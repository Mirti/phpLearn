<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Repository\Repository;
use Learn\Repository\RepositoryInterface;

class GetAllUsersRequestHandler implements RequestHandlerInterface
{

    /** @var RepositoryInterface */
    private $repository;

    /**
     * GetAllUserRequestHandler constructor.
     *
     * @param RepositoryInterface $repository
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
        $users = $this->repository->getAll();

        return new HttpResponse(200, $users ?? []);
    }
}