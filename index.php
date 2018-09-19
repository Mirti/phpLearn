<?php
declare(strict_types=1);

namespace Learn;


use Learn\Http\Message\Request\HttpRequest;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Log\Logger;
use Learn\Repository\Exception\ApiException;
use Learn\Routing\Router;
use Learn\Routing\UrlMapper;
use function http_response_code;

error_reporting(0);

/** Run auto-loading */
require __DIR__ . '/vendor/autoload.php';

$config = include(__DIR__ . '/config/local.php');


try {
    $logger = new Logger($config['logger']);

    $url           = $_SERVER['REQUEST_URI'];
    $method        = $_SERVER['REQUEST_METHOD'];
    $remoteAddress = $_SERVER['REMOTE_ADDR'];
    $body          = json_decode(file_get_contents('php://input'), true) ?? [];

    $urlMapper   = new UrlMapper($url);
    $route       = $urlMapper->toRoute($config['routes']);
    $routeParams = $urlMapper->toRouteParams($route);

    $request = new HttpRequest($remoteAddress, $method, $url, $route, $routeParams, $body);

    $router = new Router($config['routes']);

    $requestHandler = $router->match($request);
    /** @var ResponseInterface $response */
    $response = $requestHandler->handle($request);

} catch (ApiException $ex) {
    $response = new HttpResponse($ex->getCode(), [$ex->getMessage()]);

} catch (\Throwable $ex) {
    $logger->emergency($ex->getMessage());
    $response = new HttpResponse(500);
}
header('Content-Type: application/json');
if ($response->getCode() !== 204) {
    echo $response;
}
http_response_code($response->getCode());