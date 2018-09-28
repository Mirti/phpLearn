<?php
declare(strict_types=1);

namespace Learn\Http\Middleware\Factory;


use Learn\Http\Middleware\DefaultMiddleware;
use Learn\Http\Middleware\MiddlewareInterface;
use Learn\Http\Middleware\RequestBodyValidationMiddleware;
use Learn\Routing\Router;

class MiddlewareFactory
{
    /**
     * @param $class
     * @return MiddlewareInterface
     */
    public static function create($class): MiddlewareInterface
    {
        $config = require ROOT_DIR . '/config/local.php';

        switch ($class) {
            case DefaultMiddleware::class:
                $router = new Router($config['routes']);

                return new DefaultMiddleware($router);
                break;

            case RequestBodyValidationMiddleware::class:
                return new RequestBodyValidationMiddleware($config['routes']);
                break;

            default:
                return new $class();
        }
    }
}