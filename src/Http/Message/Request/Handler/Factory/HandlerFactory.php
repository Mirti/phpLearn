<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler\Factory;


use Learn\Database\Factory\PdoConnectionFactory;
use Learn\Http\Message\Request\Handler\AddUserRequestHandler;
use Learn\Http\Message\Request\Handler\DefaultHandler;
use Learn\Http\Message\Request\Handler\FindUserRequestHandler;
use Learn\Http\Message\Request\Handler\GetAllUsersRequestHandler;
use Learn\Http\Message\Request\Handler\RequestHandlerInterface;
use Learn\Repository\UserRepository;

class HandlerFactory
{
    /**
     * @param string $class
     * @param string $id
     * @return RequestHandlerInterface
     */
    public static function create(string $class, string $id = null): RequestHandlerInterface
    {
        switch ($class) {

            case GetAllUsersRequestHandler::class:
                return new GetAllUsersRequestHandler(new UserRepository(PdoConnectionFactory::create()));
                break;

            case AddUserRequestHandler::class:
                return new AddUserRequestHandler(new UserRepository(PdoConnectionFactory::create()));
                break;

            case FindUserRequestHandler::class:
                return new FindUserRequestHandler(new UserRepository(PdoConnectionFactory::create()), $id);

            default:
                return new DefaultHandler();
                break;
        }
    }
}
