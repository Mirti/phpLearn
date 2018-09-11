<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Model\Value\FirstName;
use Learn\Model\Value\LastName;
use Learn\Model\Value\UserId;
use Learn\Repository\UserRepositoryInterface;

class UpdateUserRequestHandler implements RequestHandlerInterface
{

    /** @var */
    private $repository;

    /**
     * UpdateUserRequestHandler constructor.
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

        $id = $request->getRouteParams()[':id'];

        $user = $this->repository->find(new UserId($id));

        $user->setFirstName(new FirstName($data['firstName']));
        $user->setLastName(new LastName($data['lastName']));

        $this->repository->update($user);

        $updatedUser = $this->repository->find(new UserId($id));

        return new HttpResponse(200, $updatedUser->toArray());
    }
}