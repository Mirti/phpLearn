<?php
declare(strict_types=1);

use Learn\Routing\Router;

/** Run auto-loading */
require __DIR__ . '/vendor/autoload.php';

try {
    $config = include(__DIR__ . '/config/local.php');

    $path = $_SERVER['REQUEST_URI'];

    $request = $config['routes'][$path]['type'];

    $router       = new Router($config);
    $matchedClass = $router->match($path,$request);


    /** @var \Learn\Http\Server\RequestHandlerInterface $testObject */
    $testObject = new $matchedClass;
    $testObject->handle($request);


} catch (\PDOException $ex) {
    echo "PDO Exception Response";
    echo $ex;
} catch (\InvalidArgumentException $ex) {
    echo "Invalid Argument Response";
    echo $ex;
} catch (\Throwable $ex) {
    echo "Other error: " . $ex->getMessage();
    echo $ex;
}



