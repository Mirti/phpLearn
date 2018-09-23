<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Learn\Database\PdoConnection;
use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Model\User;
use Learn\Model\Value\FirstName;
use Learn\Model\Value\LastName;
use Learn\Model\Value\UserId;
use Learn\Repository\Exception\ApiException;
use Learn\Repository\UserRepositoryInterface;

class AddUserRequestHandler implements RequestHandlerInterface
{
    /** @var PdoConnection */
    private $connection;

    /** @var UserRepositoryInterface */
    private $repository;

    /**
     * AddUserRequestHandler constructor.
     *
     * @param PdoConnection           $connection
     * @param UserRepositoryInterface $repository
     */
    public function __construct(PdoConnection $connection, UserRepositoryInterface $repository)
    {
        $this->connection = $connection;
        $this->repository = $repository;
    }

    /**
     * @inheritdoc
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        $data = $request->getBody();

        if (!array_key_exists('firstName', $data) || !array_key_exists('lastName', $data)) {
            throw new ApiException('Missing one of required field.', 400);
        }

        if ($params = array_diff(array_keys($data), ['firstName', 'lastName'])) {
            throw new ApiException('Too many arguments: ' . implode(',', $params), 400);
        }

        $id = UserId::generate();

        try {
            $user = new User($id, new FirstName($data['firstName']), new LastName($data['lastName']));
        } catch (\InvalidArgumentException $ex) {
            throw new ApiException($ex->getMessage(), 400, $ex);
        }

        $this->connection->beginTransaction();

        try {
            $this->repository->add($user);
            $createdUser = $this->repository->find($id)->toArray();
            $response    = new HttpResponse(201, $createdUser);
            $this->connection->commit();

        } catch (\Throwable $ex) {
            $this->connection->rollBack();
            throw $ex;
        }

        return $response;

    }
}