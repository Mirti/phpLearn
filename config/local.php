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
        'txt' => [
            'handler'   => [
                'class'  => \Learn\Log\LogHandler\FileHandler::class,
                'params' => [
                    'dir'  => dirname(__DIR__),
                    'name' => 'log',
                    'ext'  => 'txt',
                ]
            ],
            'formatter' => [
                'class'  => \Learn\Log\Formatter\TextFormatter::class,
                'params' => [
                    'tet1' => 'test',
                    'test2'=> 'test2'
                ]
            ]
        ],

        'html'    => [
            'handler'   => [
                'class'  => \Learn\Log\LogHandler\FileHandler::class,
                'params' => [
                    'dir'  => dirname(__DIR__),
                    'name' => 'log',
                    'ext'  => 'html',
                ]
            ],
            'formatter' => [
                'class'  => \Learn\Log\Formatter\JsonFormatter::class,
                'params' => [
                ]
            ]
        ],
        'console' => [
            'handler'   => [
                'class'  => \Learn\Log\LogHandler\ConsoleHandler::class,
                'params' => [
                ]
            ],
            'formatter' => [
                'class'  => \Learn\Log\Formatter\TextFormatter::class,
                'params' => [
                ]
            ]
        ]
    ]

];