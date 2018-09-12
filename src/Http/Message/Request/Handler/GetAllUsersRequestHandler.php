<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Repository\UserRepositoryInterface;

class GetAllUsersRequestHandler implements RequestHandlerInterface
{
    /** @var UserRepositoryInterface */
    private $repository;

    /**
     * GetAllUserRequestHandler constructor.
     *
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
        $this->repository->beginTransaction();
        try {
            $users = $this->repository->fetchAll();

            $this->repository->commitTransaction();
            return new HttpResponse(200, $users ?? []);
        } catch(\Throwable $ex){
            $this->repository->rollbackTransaction();
            throw $ex;
        }
    }
}