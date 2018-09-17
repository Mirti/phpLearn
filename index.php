<?php
declare(strict_types=1);

namespace Learn;


use Assert\AssertionFailedException;
use Learn\Http\Message\Request\HttpRequest;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Log\Logger;
use Learn\Repository\Exception\UserNotFoundException;
use Learn\Routing\Router;
use Learn\Routing\UrlMapper;
use function http_response_code;

error_reporting(0);

/** Run auto-loading */
require __DIR__ . '/vendor/autoload.php';

$config = include(__DIR__ . '/config/local.php');

$logger = new Logger($config['logger']);

try {
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
} catch (AssertionFailedException $ex) {
    $response = new HttpResponse(400, [$ex->getMessage()]);
} catch (\InvalidArgumentException $ex) {
    $response = new HttpResponse(400, [$ex->getMessage()]);
} catch (UserNotFoundException $ex) {
    $response = new HttpResponse(404, [$ex->getMessage()]);
} catch (\Throwable $ex) {
    $logger->addLog($ex, $request);
    $response = new HttpResponse(500);
}
header('Content-Type: application/json');
if ($response->getCode() !== 204) {
    echo $response;
}
http_response_code($response->getCode());