<?php
declare(strict_types=1);

use Learn\Http\Message\Request\Handler\AddUserRequestHandler;
use Learn\Http\Message\Request\Handler\DefaultHandler;
use Learn\Http\Message\Request\Handler\DeleteUserRequestHandler;
use Learn\Http\Message\Request\Handler\FindUserRequestHandler;
use Learn\Http\Message\Request\Handler\GetAllUsersRequestHandler;
use Learn\Http\Message\Request\Handler\UpdateUserRequestHandler;

return [
    'database' => [
        'default' => [
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
        ]
    ],
    'routes'   => [
        '/'          => [
            'GET' => DefaultHandler::class
        ],
        '/users'     => [
            'GET'  => GetAllUsersRequestHandler::class,
            'POST' => AddUserRequestHandler::class,
        ],
        '/users/:id' => [
            'GET'    => FindUserRequestHandler::class,
            'PUT'    => UpdateUserRequestHandler::class,
            'DELETE' => DeleteUserRequestHandler::class
        ]
    ],
    'logger'   => [
        'handler' => [
            'txt' => [
                'fileDir'          => dirname(__DIR__),
                'fileName'         => 'log',
                'fileExtension'    => 'txt',
                'handler'          => \Learn\Log\LogHandler\FileHandler::class,
                'contentFormatter' => \Learn\Log\Formatter\TextFormatter::class
            ],

            'html'    => [
                'fileDir'          => dirname(__DIR__),
                'fileName'         => 'log',
                'fileExtension'    => 'html',
                'handler'          => \Learn\Log\LogHandler\FileHandler::class,
                'contentFormatter' => \Learn\Log\Formatter\JsonFormatter::class
            ],
            'console' => [
                'handler'          => \Learn\Log\LogHandler\ConsoleHandler::class,
                "contentFormatter" => \Learn\Log\Formatter\TextFormatter::class
            ]
        ]
    ]

];