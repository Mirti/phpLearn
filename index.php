<?php
declare(strict_types=1);

namespace Learn;


use Learn\Http\Message\Request\HttpRequest;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Log\Logger;
use Learn\Log\LogHandler\Factory\LogHandlerFactory;
use Learn\Repository\Exception\ApiException;
use Learn\Routing\MiddlewareMatcher;
use Learn\Routing\Router;
use Learn\Routing\UrlMapper;
use function http_response_code;

error_reporting(1);
ini_set('display_errors', 'true');

/** Run auto-loading */
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/constants.php';

$config = require __DIR__ . '/config/local.php';

$logger = new Logger(LogHandlerFactory::create($config['logger']));

try {
    $url           = $_SERVER['REQUEST_URI'];
    $method        = $_SERVER['REQUEST_METHOD'];
    $remoteAddress = $_SERVER['REMOTE_ADDR'];
    $body          = json_decode(file_get_contents('php://input'), true) ?? [];

    $urlMapper   = new UrlMapper($url);
    $route       = $urlMapper->toRoute($config['routes']);
    $routeParams = $urlMapper->toRouteParams($route);

    $request = new HttpRequest($remoteAddress, $method, $url, $route, $routeParams, $body);

    $router         = new Router($config['routes']);
    $requestHandler = $router->match($request);

    $middlewareMatcher = new MiddlewareMatcher($config['routes']);
    $middleware        = $middlewareMatcher->match($request);

    /** @var ResponseInterface $response */
    $response = $requestHandler->handle($request);


} catch (\Throwable $ex) {
    if ($ex instanceof ApiException) {
        $response = new HttpResponse($ex->getCode(), [$ex->getMessage()]);
    } else {
        $logger->emergency($ex->getMessage(), [$ex->__toString()]);
        $response = new HttpResponse(500, ['message' => 'Internal Server Error']);
    }
}

header('Content-Type: application/json');
if ($response->getCode() !== 204) {
    echo $response;
}
http_response_code($response->getCode());