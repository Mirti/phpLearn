<?php
declare(strict_types=1);

/** Run auto-loading */
require __DIR__ . '/vendor/autoload.php';

use Learn\Routing\Router;

Router::match($_SERVER['REQUEST_URI']);



