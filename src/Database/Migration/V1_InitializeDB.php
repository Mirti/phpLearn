<?php
declare(strict_types=1);

$config =  include(dirname(dirname(dirname(dirname(__FILE__)))) . "/config/local.php");  //Jakiś inny sposób?

$config = $config['database']['default'];

$host     = $config['dsn']['host'] . ':' . $config['dsn']['port'];
$dbName   = $config['dsn']['dbname'];
$username = $config['credentials']['username'];
$password = $config['credentials']['password'];

try {
    $conn = new PDO("mysql:host=$host", $username, $password);

    $dropSQL = "DROP DATABASE IF EXIST $dbName";
    $conn->exec($dropSQL);

    $createSQL = "CREATE DATABASE $dbName";
    $conn->exec($createSQL);

    $conn = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);

    $structureSQL = "create table users(
    id         varchar(36)  not null primary key,
    firstName  varchar(255) null,
    lastName   varchar(255) null,
    deleted_at timestamp    null)";

    $conn->exec($structureSQL);
    echo "Database created";

} catch (\Throwable $ex) {
    echo $ex->getMessage();
}