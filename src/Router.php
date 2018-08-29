<?php
declare (strict_types=1);

namespace \Learn;


class Router
{
    /**
     * Function for getting routes configurations
     *
     * @return array
     */
    private static function routeConfig(): array
    {
        return [
            '/users' => [
                'get'    => 'GET',
                'post'   => 'POST',
                'put'    => 'PUT',
                'delete' => 'DELETE'
            ],
        ];
    }
}