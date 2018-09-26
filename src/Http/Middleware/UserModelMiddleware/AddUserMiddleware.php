<?php
declare(strict_types=1);

namespace Learn\Http\Middleware\UserModelMiddleware;


use Learn\Http\Message\Request\Handler\RequestHandlerInterface;
use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Http\Middleware\MiddlewareInterface;
use Learn\Model\User;
use Learn\Model\Value\FirstName;
use Learn\Model\Value\LastName;
use Learn\Model\Value\UserId;
use Learn\Repository\UserRepositoryInterface;

class AddUserMiddleware implements MiddlewareInterface
{

    /** @var UserRepositoryInterface */
    private $repository;

    /**
     * AddUserMiddleware constructor.
     * @param UserRepositoryInterface $repository
     */
    function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param RequestInterface        $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $data = $request->getBody();

        $user = new User(
            $id = UserId::generate(),
            new FirstName($data['firstName']),
            new LastName($data['lastName'])
        );

        $this->repository->add($user);

        return $handler->handle($request);
    }
}