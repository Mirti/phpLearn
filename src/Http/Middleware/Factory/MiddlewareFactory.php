<?php
declare(strict_types=1);

namespace Learn\Http\Middleware\Factory;


use Learn\Http\Middleware\MiddlewareInterface;

class MiddlewareFactory
{
    /**
     * @param $class
     * @return MiddlewareInterface
     */
    public static function create($class): MiddlewareInterface
    {
        return new $class();
    }
}