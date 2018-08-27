<?php
declare (strict_types=1);

namespace Learn\Database;


use \PDO;
use \Throwable;

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

        } catch (Throwable $ex) {
            connectionError();
        }
    }

    /**
     * @inheritdoc
     */
    private function __clone()
    {

    }

    /**
     * @return PdoConnection
     *
     * Singleton method for creating or get exist class instance
     */
    public static function getInstance(): PdoConnection
    {
        if (self::$instance == null) {
            self::$instance = new PdoConnection();
        }
        return self::$instance;
    }

    /**
     * @return PDO
     *
     * Method for getting PDO connection
     */
    public function getConnection(): PDO
    {
        return $this->conn;
    }
}
