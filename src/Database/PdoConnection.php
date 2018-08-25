<?php

declare (strict_types=1);

namespace Learn\Database;


use PDO;
use Exception;

final class PdoConnection
{

    protected static $instance = null;
    private $conn;

    private $host = "localhost:3306";
    private $user = "dev";
    private $password = "dev";
    private $databaseName = "learn";

    /**
     * Pdo constructor.
     */
    protected function __construct()
    {
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->databaseName, $this->user, $this->password);
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'");
        } catch (Exception $exception) {
            echo "Connection error";
            die();
        }
    }

    private function __clone()
    {

    }

    private function __wakeup()
    {

    }


    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new PdoConnection();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}