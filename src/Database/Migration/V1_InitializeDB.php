<?php
declare(strict_types=1);

$host     = "127.0.0.1:3306";
$dbName   = "learn";
$username = "dev";
$password = "dev";

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