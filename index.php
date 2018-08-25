<?php
declare(strict_types=1);

/** Run auto-loading */
require dirname(__DIR__) . '/learn/vendor/autoload.php';

use Learn\Model\User;
use Learn\Service\UserService;

$user = new User("Krzysztof", "Ibisz");
UserService::getUsers();

