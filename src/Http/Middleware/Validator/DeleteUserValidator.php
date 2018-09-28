<?php
declare(strict_types=1);

namespace Learn\Http\Middleware\Validator;


use Learn\Database\Factory\PdoConnectionFactory;
use Learn\Http\Message\Request\RequestInterface;
use Learn\Model\Value\UserId;
use Learn\Repository\Exception\ApiException;
use Learn\Repository\Exception\UserNotFoundException;
use Learn\Repository\UserRepository;

class DeleteUserValidator implements ValidatorInterface
{

    /**
     * @param RequestInterface $request
     * @return mixed
     */
    function validate(RequestInterface $request)
    {
        $pdo        = PdoConnectionFactory::create('default');
        $repository = new UserRepository($pdo);

        $id = $request->getRouteParams()[':id'];

        try {
            $userId = UserId::fromString($id);
        } catch (\InvalidArgumentException $ex) {
            throw new ApiException($ex->getMessage(), 400);
        }

        try {
            $repository->find($userId);
        } catch (UserNotFoundException $ex) {
            throw new ApiException($ex->getMessage(), 404);
        }
    }
}