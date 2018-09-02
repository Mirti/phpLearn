<?php
declare(strict_types=1);

namespace Learn\Http\Message\Handler;


use Learn\Database\PdoConnection;
use Learn\Http\HttpResponse;
use Learn\Http\RequestInterface;

class AddUserRequestHandler implements RequestHandlerInterface
{
    /**
     * Method for handling response
     *
     * @param RequestInterface $request
     */
    public function handle(RequestInterface $request)
    {
        $data = json_decode($request->getBody(), true);
        if (!array_key_exists('firstName', $data) || !array_key_exists('lastName', $data)) {
            throw new \InvalidArgumentException();
        }
        $firstName = $data['firstName'];
        $lastName  = $data['lastName'];

        $config = include($_SERVER['DOCUMENT_ROOT'] . "/config/local.php");

        $pdo = PdoConnection::getInstance($config['database'])->getConnection();

        $sql = "INSERT INTO users (firstName, lastName) VALUES (?, ?)";
        $pdo->prepare($sql)->execute([$firstName, $lastName]);
        return new HttpResponse(201);
    }
}