<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Learn\Database\Factory\PdoConnectionFactory;
use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Repository\UserRepository;

class GetAllUsersRequestHandler implements RequestHandlerInterface
{
    /**
     * @inheritdoc
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        $pdo = PdoConnectionFactory::create();

        $repository = new UserRepository($pdo);
        $users      = $repository->getAll();

        return new HttpResponse(200, $users ?? []);
    }
}