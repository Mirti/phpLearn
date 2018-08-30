<?php
declare(strict_types=1);

namespace Learn\Http\Server\User;


use Learn\Database\PdoConnection;
use Learn\Http\RequestInterface;
use Learn\Http\Server\RequestHandlerInterface;

class GetAllUsersRequestHandler implements RequestHandlerInterface
{
    /**
     * @param RequestInterface $request
     */
    public function handle(RequestInterface $request)
    {
        $pdo = PdoConnection::getInstance()->getConnection();

        $jsonArray = array();

        $stmt = $pdo->query("SELECT * FROM users");

        while ($row = $stmt->fetch()) {
            array_push($jsonArray, $row);
        }
        echo json_encode($jsonArray);
    }
}