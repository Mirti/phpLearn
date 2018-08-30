<?php
declare(strict_types=1);

namespace Learn\Http\Server\User;


use Learn\Database\PdoConnection;
use Learn\Http\RequestInterface;
use Learn\Http\Server\RequestHandlerInterface;

class GetAllUsersRequestHandler implements RequestHandlerInterface
{

    public function handle(RequestInterface $request)
    {
        $config = include($_SERVER['DOCUMENT_ROOT'] . "/config/local.php");

        $pdo = PdoConnection::getInstance($config['database'])->getConnection();

        $jsonArray = array();

        $stmt = $pdo->query("SELECT * FROM users");

        while ($row = $stmt->fetch()) {
            array_push($jsonArray, $row);
        }
        echo json_encode($jsonArray);
    }
}