<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Repository\RepositoryInterface;

class FindUserRequestHandler implements RequestHandlerInterface
{
    /** @var RepositoryInterface */
    private $repository;

    /**
     * FindUserRequestHandler constructor.
     * @param $repository
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
        $user = $this->repository->find($request->getId());

        return new HttpResponse(200, $user->toArray() ?? []);
    }
}