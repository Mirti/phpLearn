<?php
declare (strict_types=1);

namespace Learn\Routing;


use Learn\Http\RequestInterface;
use Learn\Http\Server\RequestHandlerInterface;
use Learn\Http\Server\User\AddUserRequestHandler;
use Learn\Http\Server\User\GetAllUsersRequestHandler;
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
                         'GET'  => GetAllUsersRequestHandler::class,
                         'POST' => AddUserRequestHandler::class,
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
        /** @var RequestInterface $request */
        $request = self::routeConfig()[$path]['type'];

        $httpMethod = $request->getRequestMethod();
        $class      = "\\" . self::routeConfig()[$path][$httpMethod];

        /** @var RequestHandlerInterface $handler */
        $handler = new $class;

        $handler->handle($request);
    }
}