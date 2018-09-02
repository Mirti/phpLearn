<?php
declare(strict_types=1);

namespace Learn\Http\Message\Handler;


use Learn\Database\PdoConnection;
use Learn\Http\HttpResponse;
use Learn\Http\RequestInterface;

class GetAllUsersRequestHandler implements RequestHandlerInterface
{
    /**
     * @param RequestInterface $request
     * @return HttpResponse|mixed
     */
    public function handle(RequestInterface $request)
    {
        $config = include($_SERVER['DOCUMENT_ROOT'] . "/config/local.php");

        $pdo = PdoConnection::getInstance($config['database'])->getConnection();

        $jsonArray = array();

        $stmt = $pdo->query("SELECT * FROM users");

        while ($row = $stmt->fetch()) {
            array_push($jsonArray, $row);
        }

       // $response = new HttpResponse(201, "Ok", "1.1", null, json_encode($jsonArray));

        return new HttpResponse(200,json_encode($jsonArray));
    }
}