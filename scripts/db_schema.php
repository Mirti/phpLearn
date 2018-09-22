<?php
declare(strict_types=1);

namespace Learn;


require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../constants.php';

use Learn\Database\Factory\PdoConnectionFactory;

$conn   = PdoConnectionFactory::create('default');
$sql = '
      CREATE TABLE users(
        id         varchar(36)  NOT NULL PRIMARY KEY,
        firstName  varchar(32) NOT NULL,
        lastName   varchar(32) NOT NULL,
        deleted_at timestamp NULL)
    ';
$conn->exec($sql);

echo "Database created";