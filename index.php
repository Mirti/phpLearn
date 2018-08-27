<?php
declare(strict_types=1);

/** Run auto-loading */
require __DIR__ . '/vendor/autoload.php';

use Learn\Route\Route;

include($_SERVER['DOCUMENT_ROOT'] . '/src/Exception/HttpStatusHandler.php');

Route::route($_SERVER['REQUEST_URI']);



