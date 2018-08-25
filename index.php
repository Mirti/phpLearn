<?php
declare(strict_types=1);

use Learn\Model\User;

/** Run auto-loading */
require dirname(__DIR__) . '/learn/vendor/autoload.php';

$user     = new User('Artur', 'Nykiel');
$fullName = $user->getFirstName() . ' ' . $user->getLastName();
$test = [
    'name' => 'asd',
    'b'    => 'a'
];

$a     = 4;
$asdsa = 5;