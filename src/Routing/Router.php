<?php
declare (strict_types=1);

namespace Learn\Routing;


use Learn\Http\Handler\User\GetAllUsersRequestHandler;
use Learn\Http\UserRequest;

class Router
{

    /**
     * @return array
     */
    private static function routeConfig(): array
    {
        return [
            '/users' => ['type' => new UserRequest(),
                         //'GET'  => getAllUsers(), Da się coś takiego zrobić?
                         'GET'  => GetAllUsersRequestHandler::getAllUsers()
            ]
        ];
    }

    /**
     * Method for matching request to proper handler
     *
     * @param $path
     */
    public static function match($path)
    {
        $request    = self::routeConfig()[$path]['type'];
        $httpMethod = $request->getRequestMethod();

        // $request->self::routeConfig()[$path][$httpMethod];  Da się coś takiego zrobić?

        self::routeConfig()[$path][$httpMethod];
    }
}