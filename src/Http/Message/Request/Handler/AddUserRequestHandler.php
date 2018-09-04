<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Learn\Database\Factory\PdoConnectionFactory;
use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Model\User;
use Learn\Repository\UserRepository;
use Learn\Repository\UserRepositoryInterface;

class AddUserRequestHandler implements RequestHandlerInterface
{
    /** @var UserRepositoryInterface */
    private $repository;

    /**
     * AddUserRequestHandler constructor.
     *
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritdoc
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        $data = $request->getBody();

        if (!array_key_exists('first_name', $data) || !array_key_exists('last_name', $data)) {
            throw new \InvalidArgumentException('Missing one of required field.');
        }

        $user = new User($data['first_name'], $data['last_name']);

        $this->repository->add($user);

        return new HttpResponse(201);
    }
}