<?php
declare(strict_types=1);

namespace Learn;


use Learn\Http\Message\Request\HttpRequest;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Routing\Router;
use function http_response_code;

/** Run auto-loading */
require __DIR__ . '/vendor/autoload.php';

$config = include(__DIR__ . '/config/local.php');

$path   = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$body   = json_decode(file_get_contents('php://input'), true) ?? [];

$request = new HttpRequest($path, $method, $body);

$router = new Router($config['routes']);

try {
    $requestHandler = $router->match($request);

    /** @var ResponseInterface $response */
    $response = $requestHandler->handle($request);
} catch (\InvalidArgumentException $ex) {
    $response = new HttpResponse(400, [$ex->getMessage()]);
}

header('Content-Type: application/json');
http_response_code($response->getCode());

echo $response;

