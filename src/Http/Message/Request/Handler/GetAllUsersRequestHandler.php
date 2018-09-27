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
     * GetAllUsersRequestHandler constructor.
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
        $users      = $this->repository->fetchAll();
        $usersArray = array();

        foreach ($users as $user) {
            $usersArray[] = $user->toArray();
        }

        return new HttpResponse(200, $usersArray);
    }
}