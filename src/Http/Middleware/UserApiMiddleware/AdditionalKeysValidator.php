<?php
declare(strict_types=1);

namespace Learn\Http\Middleware\UserApiMiddleware;


class AdditionalKeysValidator
{
    /**
     * @param array $body
     * @return array
     */
    public static function getAdditionalKeys(array $body): array
    {
        return array_diff(array_keys($body), ['firstName', 'lastName']);
    }

}