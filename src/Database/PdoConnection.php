<?php
declare (strict_types=1);

namespace Learn\Database;

require $_SERVER['DOCUMENT_ROOT'] . '/config/local.php';

use \PDO;
use \Exception;

final class PdoConnection
{
    /** @var PdoConnection */
    protected static $instance = null;
    /** @var PDO */
    private $conn;

    /**
     * PdoConnection constructor.
     */
    protected function __construct()
    {
        try {
            $this->conn = new \PDO('mysql:host=' . $host . '; dbname=' . $databaseName, $user, $password);
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


    public static function getInstance(): PdoConnection
    {
        if (self::$instance == null) {
            self::$instance = new PdoConnection();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->conn;
    }
}