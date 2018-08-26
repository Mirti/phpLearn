<?php
declare(strict_types=1);

/** Run auto-loading */
require dirname(__DIR__) . '/learn/vendor/autoload.php';

use Learn\Route\Route;


echo "REST API działające już: <br />
/user  GET <br />
/user  POST <br /> <br />";

Route::route($_SERVER['REQUEST_URI']);



