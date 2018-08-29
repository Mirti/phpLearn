<?php
declare(strict_types=1);

/** Run auto-loading */
require __DIR__ . '/vendor/autoload.php';


Route::route($_SERVER['REQUEST_URI']);



