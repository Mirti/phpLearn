<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


class HandlerFactory
{
    /**
     * @param $class
     * @param $parameters
     * @return RequestHandlerInterface
     */
    public static function makeHandler($class, $parameters): RequestHandlerInterface
    {
        if (!isset($parameters)) {
            return new $class();
        } else {
            return new $class(...$parameters);
        }
    }
}
