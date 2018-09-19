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
    private const DB_NAME = 'default';

    /**
     * @param string $class
     * @return RequestHandlerInterface
     */
    public static function create(string $class): RequestHandlerInterface
    {
        $config = include($_SERVER['DOCUMENT_ROOT'] . "/config/local.php");

        switch ($class) {
            case GetAllUsersRequestHandler::class:
                return new GetAllUsersRequestHandler(
                    new UserRepository(PdoConnectionFactory::create(self::DB_NAME)));
                break;

            case AddUserRequestHandler::class:
                return new AddUserRequestHandler(
                    PdoConnectionFactory::create(self::DB_NAME),
                    new UserRepository(PdoConnectionFactory::create(self::DB_NAME)),
                    $config['logger']);
                break;

            case FindUserRequestHandler::class:
                return new FindUserRequestHandler(new UserRepository(PdoConnectionFactory::create(self::DB_NAME)));

            case UpdateUserRequestHandler::class:
                return new UpdateUserRequestHandler(
                    PdoConnectionFactory::create(self::DB_NAME),
                    new UserRepository(PdoConnectionFactory::create(self::DB_NAME)));

            case DeleteUserRequestHandler::class:
                return new DeleteUserRequestHandler(
                    PdoConnectionFactory::create(self::DB_NAME),
                    new UserRepository(PdoConnectionFactory::create(self::DB_NAME)));

            default:
                return new DefaultHandler();
                break;
        }
    }
}
