<?php
declare(strict_types=1);

use Learn\Http\HttpRequest;
use Learn\Routing\Router;
use Learn\Http\HttpResponse;

/** Run auto-loading */
require __DIR__ . '/vendor/autoload.php';

try {
    $config = include(__DIR__ . '/config/local.php');

    $path = $_SERVER['REQUEST_URI'];

    $request = new HttpRequest();

    $router       = new Router($config['routes']);
    $matchedClass = $router->match($request);

    /** @var \Learn\Http\Message\Handler\RequestHandlerInterface $testObject */
    $testObject = new $matchedClass;

    /** @var \Learn\Http\HttpResponse $response */
    $response = $testObject->handle($request);
    $response->makeResponse();


} catch (\PDOException $ex) {
    $response = new HttpResponse(503, $ex);
    $response->makeResponse();
} catch (\InvalidArgumentException $ex) {
    $response = new HttpResponse(400, $ex);
    $response->makeResponse();
} catch (\Throwable $ex) {
    $response = new HttpResponse(500, $ex);
    $response->makeResponse();
}



