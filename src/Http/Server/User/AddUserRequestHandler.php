<?php
declare(strict_types=1);

namespace Learn\Http\Server\User;


use Learn\Database\PdoConnection;
use Learn\Http\RequestInterface;
use Learn\Http\Server\RequestHandlerInterface;

class AddUserRequestHandler implements RequestHandlerInterface
{
    /**
     * Method for handling response
     *
     * @param RequestInterface $request
     */
    public function handle(RequestInterface $request)
    {
        $data = json_decode($request->getRequestBody(), true);
        if (!array_key_exists('firstName', $data) || !array_key_exists('lastName', $data)) {
            throw new \InvalidArgumentException();
        }
        $firstName = $data['firstName'];
        $lastName  = $data['lastName'];

        $pdo = PdoConnection::getInstance()->getConnection();

        $sql = "INSERT INTO users (firstName, lastName) VALUES (?, ?)";
        $pdo->prepare($sql)->execute([$firstName, $lastName]);
    }
}