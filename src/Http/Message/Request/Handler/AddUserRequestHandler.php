<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Model\User;
use Learn\Model\Value\FirstName;
use Learn\Model\Value\LastName;
use Learn\Model\Value\UserId;
use Learn\Repository\UserRepositoryInterface;

class AddUserRequestHandler implements RequestHandlerInterface
{
    /** @var UserRepositoryInterface */
    private $repository;

    /** @var  */
    private $middleware;

    /**
     * AddUserRequestHandler constructor.
     *
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository, $middleware)
    {
        $this->repository = $repository;
        $this->middleware = $middleware;
    }

    /**
     * @inheritdoc
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
//        $data = $request->getBody();
//
//        $user = new User(
//            $id = UserId::generate(),
//            new FirstName($data['firstName']),
//            new LastName($data['lastName'])
//        );
//
//        $this->repository->add($user);
//
//        $createdUser = $this->repository->find($id);
//
//        return new HttpResponse(201, $createdUser->toArray());




    }
}