<?php
declare (strict_types=1);

namespace Learn\Database;


final class PdoConnection
{
    /** @var PdoConnection */
    protected static $instance = null;
    /** @var \PDO */
    private $conn;

    /**
     * PdoConnection constructor.
     * @param array $config
     */
    protected function __construct(array $config)
    {
        $dsn = $config['driver'] . ":";
        foreach ($config['dsn'] as $key => $value) {
            $dsn = $dsn . "$key=$value;";
        }
        $this->conn = new \PDO($dsn, "dev", 'dev');
        $this->conn->exec("set names utf8");
    }

    /**
     * @inheritdoc
     */
    private function __clone()
    {

    }

    /**
     * Singleton method for creating or get exist class instance
     *
     * @param array $config
     * @return PdoConnection
     */
    public static function getInstance(array $config): PdoConnection
    {
        if (self::$instance == null) {
            self::$instance = new PdoConnection($config);
        }
        return self::$instance;
    }

    /**
     *
     * Method for getting PDO connection
     */
    public function getConnection()
    {
        return $this->conn;
    }
}
