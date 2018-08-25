<?php
declare(strict_types=1);

/** Run auto-loading */
require dirname(__DIR__) . '/learn/vendor/autoload.php';

use Learn\Database\PdoConnection;


$db = PdoConnection::getInstance();
$db->getConnection();

