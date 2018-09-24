<?php
declare(strict_types=1);

namespace Learn\Http\Middleware\UserApiMiddleware;


class BodyKeysValidator
{
    /**
     * @param array $body
     * @return bool
     */
    public static function isValid(array $body): bool
    {
        return (!array_key_exists('firstName', $body) || !array_key_exists('lastName', $body)) ? true : false;
    }
}