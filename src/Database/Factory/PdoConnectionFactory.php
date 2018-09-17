<?php
declare(strict_types=1);

namespace Learn\Database\Factory;


use Learn\Database\PdoConnection;

class PdoConnectionFactory
{
    protected static $connections = [];

    /**
     * @param string $dbName
     * @return PdoConnection
     */
    public static function create(string $dbName): PdoConnection
    {
        if (array_key_exists($dbName, self::$connections)) {
        } else {
            $config = include($_SERVER['DOCUMENT_ROOT'] . "/config/local.php");

            self::$connections[$dbName] = new PdoConnection($config['database'][$dbName]);
        }

        return self::$connections[$dbName];
    }
}