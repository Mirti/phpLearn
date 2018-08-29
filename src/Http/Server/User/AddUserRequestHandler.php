<?php
declare(strict_types=1);

namespace Learn\Http\Server\User;


use http\Exception\InvalidArgumentException;
use Learn\Database\PdoConnection;
use Learn\Http\RequestInterface;
use Learn\Http\Server\RequestHandlerInterface;
use Throwable;

class AddUserRequestHandler implements RequestHandlerInterface
{
    /**
     * Method for handling response
     *
     * @param RequestInterface $request
     */
    public function handle(RequestInterface $request)
    {
        try {
            $data      = json_decode($request->getRequestBody(), true);
            $firstName = $data['firstName'];
            $lastName  = $data['lastName'];
        } catch (Throwable $ex) {
            throw $ex;
        }

        $pdo = PdoConnection::getInstance()->getConnection();

        $sql = "INSERT INTO users (firstName, lastName) VALUES (?, ?)";
        $pdo->prepare($sql)->execute([$firstName, $lastName]);
    }
}