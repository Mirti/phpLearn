<?php
declare(strict_types=1);

namespace Learn\Http\Middleware\Factory;


use Learn\Http\Middleware\DefaultMiddleware;
use Learn\Http\Middleware\MiddlewareInterface;
use Learn\Routing\Router;

class MiddlewareFactory
{
    /**
     * @param $class
     * @return MiddlewareInterface
     */
    public static function create($class): MiddlewareInterface
    {
        if ($class == DefaultMiddleware::class) {
            $config = require ROOT_DIR . '/config/local.php';
            $router = new Router($config['routes']);

            return new DefaultMiddleware($router);
        }

        return new $class();
    }
}