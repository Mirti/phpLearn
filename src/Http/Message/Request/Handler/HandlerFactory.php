<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Learn\Database\Factory\PdoConnectionFactory;
use Learn\Repository\UserRepository;

class HandlerFactory
{
    /**
     * @param $class
     * @return RequestHandlerInterface
     */
    public static function create($class): RequestHandlerInterface
    {
        switch ($class) {

            case GetAllUsersRequestHandler::class:
                return new GetAllUsersRequestHandler(new UserRepository(PdoConnectionFactory::create()));
                break;

            case AddUserRequestHandler::class:
                return new AddUserRequestHandler(new UserRepository(PdoConnectionFactory::create()));
                break;

            default:
                return new DefaultHandler();
                break;
        }
    }
}
