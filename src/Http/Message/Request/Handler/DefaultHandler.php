<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;

class DefaultHandler implements RequestHandlerInterface
{
    /**
     * @inheritdoc
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        $info = [
            'Available routes'    => [
                '/users'      => [
                    'GET'  => 'List of all users',
                    'POST' => 'Create new user',
                ],
                '/users/{id}' => [
                    'PUT'    => 'Update users with {id}',
                    'DELETE' => 'delete users with {id}',
                ]
            ],
            'Required parameters' => [
                '/users'      => [
                    'GET'  => "-",
                    'POST' => "firstName, lastName",
                ],
                '/users/{id}' => [
                    'PUT'    => 'firstName, lastName',
                    'DELETE' => '-',
                ]
            ]
        ];

        return new HttpResponse(200, $info);
    }
}