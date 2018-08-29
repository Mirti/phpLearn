<?php
declare(strict_types=1);

/** Run auto-loading */
require __DIR__ . '/vendor/autoload.php';

use Learn\Routing\Router;

try {
    Router::match($_SERVER['REQUEST_URI']);
} catch (PDOException $ex) {
    echo "PDO Exception Response";
} catch (Exception $ex) {
    echo "Invalid Arguments Response";
}



