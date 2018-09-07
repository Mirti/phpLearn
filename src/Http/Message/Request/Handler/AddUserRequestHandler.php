<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Model\User;
use Learn\Repository\UserRepositoryInterface;
use Rhumsaa\Uuid\Uuid;

class AddUserRequestHandler implements RequestHandlerInterface
{
    /** @var UserRepositoryInterface */
    private $repository;

    /**
     * AddUserRequestHandler constructor.
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
        $data = $request->getBody();

        if (!array_key_exists('firstName', $data) || !array_key_exists('lastName', $data)) {
            throw new \InvalidArgumentException('Missing one of required field.');
        }

        $id   = Uuid::uuid4()->toString();
        $user = new User($id, $data['firstName'], $data['lastName']);
        $this->repository->add($user);

        $createdUser = $this->repository->find($id);

        return new HttpResponse(201, $createdUser->toArray());
    }
}