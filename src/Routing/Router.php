<?php
declare (strict_types=1);

namespace Learn\Routing;


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
                         'GET'     => "Test",
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

        $request->self::routeConfig()[$path][$httpMethod];
    }

}