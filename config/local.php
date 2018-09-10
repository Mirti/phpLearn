<?php
declare(strict_types=1);

use Learn\Http\Message\Request\Handler\AddUserRequestHandler;
use Learn\Http\Message\Request\Handler\DefaultHandler;
use Learn\Http\Message\Request\Handler\GetAllUsersRequestHandler;
use Learn\Http\Message\Request\Handler\FindUserRequestHandler;
use Learn\Http\Message\Request\Handler\UpdateUserRequestHandler;
use Learn\Http\Message\Request\Handler\DeleteUserRequestHandler;

return [
    'database' => [
        'driver'      => 'mysql',
        'dsn'         => [
            'host'    => '127.0.0.1',
            'port'    => 3306,
            'dbname'  => 'learn',
            'charset' => 'utf8'
        ],
        'credentials' => [
            'username' => 'dev',
            'password' => 'dev',
        ]
    ],
    'routes'   => [
        '/'      => [
            'GET' => DefaultHandler::class
        ],
        '/users' => [
            'GET'  => GetAllUsersRequestHandler::class,
            'POST' => AddUserRequestHandler::class,
        ],
        '/users/:id' => [
            'GET' => FindUserRequestHandler::class,
            'PUT' => UpdateUserRequestHandler::class,
            'DELETE' => DeleteUserRequestHandler::class
        ]
    ]
];