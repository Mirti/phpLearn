<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler\Factory;


use Learn\Database\Factory\PdoConnectionFactory;
use Learn\Http\Message\Request\Handler\AddUserRequestHandler;
use Learn\Http\Message\Request\Handler\DefaultHandler;
use Learn\Http\Message\Request\Handler\DeleteUserRequestHandler;
use Learn\Http\Message\Request\Handler\FindUserRequestHandler;
use Learn\Http\Message\Request\Handler\GetAllUsersRequestHandler;
use Learn\Http\Message\Request\Handler\RequestHandlerInterface;
use Learn\Http\Message\Request\Handler\UpdateUserRequestHandler;
use Learn\Repository\UserRepository;

class HandlerFactory
{
    /**
     * @param string $class
     * @param array  $middleware
     * @return RequestHandlerInterface
     */
    public static function create(string $class, array $middleware): RequestHandlerInterface
    {
        $pdo        = function () {
            return PdoConnectionFactory::create(PdoConnectionFactory::DB_DEFAULT);
        };
        $repository = function () use ($pdo) {
            return new UserRepository($pdo());
        };

        switch ($class) {
            case GetAllUsersRequestHandler::class:
                return new $class($repository());

            case AddUserRequestHandler::class:
                return new $class($repository(), $middleware);

            case FindUserRequestHandler::class:
                return new $class($repository(), $middleware);

            case UpdateUserRequestHandler::class:
                return new $class($repository(), $middleware);

            case DeleteUserRequestHandler::class:
                return new $class($repository(), $middleware);

            default:
                return new DefaultHandler();
                break;
        }
    }
}
