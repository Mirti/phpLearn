<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Learn\Database\Factory\PdoConnectionFactory;
use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Model\User;
use Learn\Repository\UserRepository;

class AddUserRequestHandler implements RequestHandlerInterface
{
    /**
     * @inheritdoc
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        $data = $request->getBody();

        if (!array_key_exists('first_name', $data) || !array_key_exists('last_name', $data)) {
            throw new \InvalidArgumentException('Missing one of required field.');
        }

        $user = new User($data['first_name'], $data['last_name']);

        $pdo        = PdoConnectionFactory::create();
        $repository = new UserRepository($pdo);

        $repository->add($user);

        return new HttpResponse(201);
    }
}