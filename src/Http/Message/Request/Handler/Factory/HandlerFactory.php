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
use Learn\Log\Logger;
use Learn\Log\LogHandler\Factory\LogHandlerFactory;
use Learn\Repository\UserRepository;
use const ROOT_DIR;

class HandlerFactory
{
    /**
     * @param string $class
     *
     * @return RequestHandlerInterface
     */
    public static function create(string $class): RequestHandlerInterface
    {
        $config = require ROOT_DIR . '/config/local.php';

        $pdo        = function () { return PdoConnectionFactory::create(PdoConnectionFactory::DB_DEFAULT); };
        $repository = function () use ($pdo) { return new UserRepository($pdo()); };
        $logger     = function () use ($config) { return new Logger(LogHandlerFactory::create($config['logger'])); };

        switch ($class) {
            case GetAllUsersRequestHandler::class:
                return new $class($repository(), $logger());

            case AddUserRequestHandler::class:
                return new $class($pdo(), $repository(), $logger());

            case FindUserRequestHandler::class:
                return new $class($repository(), $logger());

            case UpdateUserRequestHandler::class:
                return new $class($pdo(), $repository(), $logger());

            case DeleteUserRequestHandler::class:
                return new $class($pdo(), $repository(), $logger());

            default:
                return new DefaultHandler();
                break;
        }
    }
}
