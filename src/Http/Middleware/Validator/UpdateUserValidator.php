<?php
declare(strict_types=1);

namespace Learn\Http\Middleware\Validator;


use Learn\Database\Factory\PdoConnectionFactory;
use Learn\Http\Message\Request\RequestInterface;
use Learn\Model\Value\UserId;
use Learn\Repository\Exception\ApiException;
use Learn\Repository\Exception\UserNotFoundException;
use Learn\Repository\UserRepository;

class UpdateUserValidator implements ValidatorInterface
{

    /**
     * @param RequestInterface $request
     * @return mixed|void
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

        $body = $request->getBody();

        if (!array_key_exists('firstName', $body) || !array_key_exists('lastName', $body)) {
            throw new ApiException("Missing one of required field", 400);
        }

        $additionalKeys = array_diff(array_keys($body), ['firstName', 'lastName']);
        if ($additionalKeys) {
            throw new ApiException('Too many arguments: ' . implode(',', $additionalKeys), 400);
        }

    }
}

