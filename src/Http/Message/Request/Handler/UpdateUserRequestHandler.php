<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Model\Value\FirstName;
use Learn\Model\Value\LastName;
use Learn\Model\Value\UserId;
use Learn\Repository\Exception\ApiException;
use Learn\Repository\Exception\UserNotFoundException;
use Learn\Repository\UserRepository;

class UpdateUserRequestHandler implements RequestHandlerInterface
{
    /** @var UserRepository */
    private $repository;

    /**
     * UpdateUserRequestHandler constructor.
     * @param $repository
     */
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritdoc
     * @throws ApiException
     */
    public function handle(RequestInterface $request): ResponseInterface
    {

        $data = $request->getBody();

        $id = $request->getRouteParams()[':id'];

        $userId = UserId::fromString($id);

        try {
            $user = $this->repository->find($userId);

        } catch (UserNotFoundException $ex) {
            throw new ApiException($ex->getMessage(), 404);
        }

        $user->setFirstName(new FirstName($data['firstName']));
        $user->setLastName(new LastName($data['lastName']));

        $this->repository->update($user);
        $updatedUser = $this->repository->find(UserId::fromString($id));

        $response = new HttpResponse(200, $updatedUser->toArray());

        return $response;
    }
}