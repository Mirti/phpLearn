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

    /** @var  */
    private $id;

    /**
     * FindUserRequestHandler constructor.
     * @param $repository
     * @param $id
     */
    public function __construct($repository, $id)
    {
        $this->repository = $repository;
        $this->id = $id;
    }

    /**
     * @inheritdoc
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        $user = $this->repository->find($this->id);

        return new HttpResponse(200, $user->toArray() ?? []);
    }
}