<?php

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
        '/users' => ['type' => new \Learn\Http\UserRequest(),
                     'GET'  => \Learn\Http\Server\User\GetAllUsersRequestHandler::class,
                     'POST' => \Learn\Http\Server\User\AddUserRequestHandler::class,
        ]

    ]
];