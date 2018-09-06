<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Model\User;
use Learn\Repository\RepositoryInterface;
use Rhumsaa\Uuid\Uuid;

class AddUserRequestHandler implements RequestHandlerInterface
{
    /** @var RepositoryInterface */
    private $repository;

    /**
     * AddUserRequestHandler constructor.
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
        $data = $request->getBody();

        if (!array_key_exists('firstName', $data) || !array_key_exists('lastName', $data)) {
            throw new \InvalidArgumentException('Missing one of required field.');
        }

        $id = Uuid::uuid4();

        $user = new User($data['firstName'], $data['lastName'], $id->toString());


        $this->repository->add($user);

        $insertedUser = $this->repository->find($id->toString());

        return new HttpResponse(201, $insertedUser);
    }
}