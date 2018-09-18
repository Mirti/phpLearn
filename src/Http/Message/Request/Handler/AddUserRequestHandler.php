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
use Learn\Repository\Exception\ApiException;
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
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritdoc
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        $this->repository->beginTransaction();

        try {
            $data = $request->getBody();

            if (!array_key_exists('firstName', $data) || !array_key_exists('lastName', $data)) {
                throw new \InvalidArgumentException('Missing one of required field.');
            }

            foreach ($data as $key => $value) {
                if ($key != 'firstName' && $key != 'lastName') {
                    $additionalArguments[] = $key;
                }
            }

            if (sizeof($additionalArguments) > 0) {
                $errorMessage = "Too many arguments (" . implode(', ', $additionalArguments) . ")";
                throw new \InvalidArgumentException($errorMessage);
            }

            $id   = UserId::generate();
            $user = new User($id, new FirstName($data['firstName']), new LastName($data['lastName']));

            $this->repository->add($user);
            $createdUser = $this->repository->find($id)->toArray();

            $this->repository->commitTransaction();

            return new HttpResponse(201, $createdUser);

        } catch (\InvalidArgumentException $ex) {
            $this->repository->rollbackTransaction();
            throw new ApiException($ex->getMessage(), 400, $ex);
        }
    }
}