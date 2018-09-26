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

    /** @var  */
    private $middleware;

    /**
     * UpdateUserRequestHandler constructor.
     * @param $repository
     * @param $middleware
     */
    public function __construct($repository, $middleware)
    {
        $this->repository = $repository;
        $this->middleware = $middleware;
    }

    /**
     * @inheritdoc
     * @throws ApiException
     */
    public function handle(RequestInterface $request): ResponseInterface
    {

        $data = $request->getBody();

        if (!array_key_exists('firstName', $data) || !array_key_exists('lastName', $data)) {
            throw new ApiException('Missing one of required field.', 400);
        }

        $id = $request->getRouteParams()[':id'];

        if (!isset($id)) {
            throw new ApiException("Can not access User ID", 404);
        }


        try {
            $userId = UserId::fromString($id);

        } catch (\InvalidArgumentException $ex) {
            throw new ApiException($ex->getMessage(), 400);
        }

        try {
            $user = $this->repository->find($userId);

        } catch (UserNotFoundException $ex) {
            throw new ApiException($ex->getMessage(), 404);
        }

        $user->setFirstName(new FirstName($data['firstName']));
        $user->setLastName(new LastName($data['lastName']));

        try {
            $this->repository->update($user);
            $updatedUser = $this->repository->find(UserId::fromString($id));

            $response = new HttpResponse(200, $updatedUser->toArray());

        } catch (\Throwable $ex) {
            throw $ex;
        }

        return $response;
    }
}