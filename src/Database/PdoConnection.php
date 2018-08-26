<?php
declare (strict_types=1);

namespace Learn\Database;


use \PDO;
use \Exception;

include($_SERVER['DOCUMENT_ROOT'] . '/src/Exception/HttpStatusHandler.php');

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
        $config   = include($_SERVER['DOCUMENT_ROOT'] . '/config/local.php');
        $database = $config['database'];

        try {
            $this->conn = new \PDO('mysql:host=' . $database['host'] . '; dbname=' . $database['dbName'],
                $database['user'], $database['password']);
            $this->conn->exec("set names utf8");

        } catch (Exception $exception) {
            serviceUnavailable();
        }
    }

    /**
     *@inheritdoc
     */
    private function __clone()
    {

    }

    /**
     * @inheritdoc
     */
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
