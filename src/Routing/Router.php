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
            '/users' => new UserRequest(),
            [
                'GET'  => "test",
            ],
        ];
    }

    /**
     * Method for matching request to proper handler
     *
     * @param $path
     */
    public static function match($path)
    {
        $request = self::routeConfig()[$path];
        $httpMethod = $request->getRequestMethod();

        var_dump(self::routeConfig()[$path][$httpMethod]);
    }

}