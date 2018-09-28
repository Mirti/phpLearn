<?php
declare(strict_types=1);

namespace Learn\Http\Middleware\Validator;


use Learn\Http\Message\Request\RequestInterface;
use Learn\Repository\Exception\ApiException;

class AddUserValidator implements ValidatorInterface
{

    /**
     * @param RequestInterface $request
     * @return mixed|void
     */
    function validate(RequestInterface $request)
    {
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

