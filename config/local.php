<?php

use Learn\Http\Message\Handler\AddUserRequestHandler;
use Learn\Http\Message\Handler\DefaultHandler;
use Learn\Http\Message\Handler\GetAllUsersRequestHandler;

/** Return app config */
return [
    'database' => [
        'driver'      => "mysql",
        'dsn'         => [
            'host'   => '127.0.0.1',
            'port'   => 3306,
            'dbname' => 'learn'
        ],
        'credentials' => [
            'user'     => 'dev',
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
        ]

    ]
];