<?php
declare(strict_types=1);

use Learn\Http\Message\Request\Handler\AddUserRequestHandler;
use Learn\Http\Message\Request\Handler\DefaultHandler;
use Learn\Http\Message\Request\Handler\DeleteUserRequestHandler;
use Learn\Http\Message\Request\Handler\FindUserRequestHandler;
use Learn\Http\Message\Request\Handler\GetAllUsersRequestHandler;
use Learn\Http\Message\Request\Handler\UpdateUserRequestHandler;
use Learn\Http\Middleware\RequestValidationMiddleware;
use Learn\Http\Middleware\Validator\AddUserValidator;
use Learn\Http\Middleware\Validator\DeleteUserValidator;
use Learn\Http\Middleware\Validator\FindUserValidator;
use Learn\Http\Middleware\Validator\UpdateUserValidator;
use Learn\Log\Formatter\JsonFormatter;
use Learn\Log\Formatter\TextFormatter;
use Learn\Log\LogHandler\ConsoleHandler;
use Learn\Log\LogHandler\FileHandler;

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
        '/'      => [
            'GET' => DefaultHandler::class
        ],
        '/users' => [
            'GET' => [
                'handler'    => GetAllUsersRequestHandler::class,
                'middleware' => [],
            ],

            'POST' => [
                'handler'    => AddUserRequestHandler::class,
                'middleware' => [
                    RequestValidationMiddleware::class
                ],
                'validator'  => AddUserValidator::class
            ]],

        '/users/:id' => [
            'GET'    => [
                'handler'    => FindUserRequestHandler::class,
                'middleware' => [RequestValidationMiddleware::class],
                'validator'  => FindUserValidator::class
            ],
            'PUT'    => [
                'handler'    => UpdateUserRequestHandler::class,
                'middleware' => [RequestValidationMiddleware::class],
                'validator'  => UpdateUserValidator::class
            ],
            'DELETE' => [
                'handler'    => DeleteUserRequestHandler::class,
                'middleware' => [RequestValidationMiddleware::class],
                'validator'  => DeleteUserValidator::class
            ],
        ]
    ],
    'logger'   => [
        [
            'handler'   => [
                'class'  => FileHandler::class,
                'params' => [
                    'file' => ROOT_DIR . '/logs/txt_logs.txt'
                ]
            ],
            'formatter' => [
                'class'  => TextFormatter::class,
                'params' => [
                ]
            ]
        ],
        [
            'handler'   => [
                'class'  => FileHandler::class,
                'params' => [
                    'file' => ROOT_DIR . '/logs/json_logs.log'
                ]
            ],
            'formatter' => [
                'class'  => JsonFormatter::class,
                'params' => []
            ]
        ],
        [
            'handler'   => [
                'class'  => ConsoleHandler::class,
                'params' => []
            ],
            'formatter' => [
                'class'  => TextFormatter::class,
                'params' => []
            ]
        ]

    ]
];
