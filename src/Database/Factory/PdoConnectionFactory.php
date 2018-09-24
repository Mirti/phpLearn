<?php
declare(strict_types=1);

namespace Learn\Database\Factory;


use Learn\Database\PdoConnection;
use const ROOT_DIR;

class PdoConnectionFactory
{
    const DB_DEFAULT = 'default';

    /** @var PdoConnection[] */
    protected static $connections = [];

    /**
     * @param string $dbName
     *
     * @return PdoConnection
     */
    public static function create(string $dbName): PdoConnection
    {
        if (!array_key_exists($dbName, self::$connections)) {
            $config = require ROOT_DIR . '/config/local.php';

            self::$connections[$dbName] = new PdoConnection($config['database'][$dbName]);
        }

        return self::$connections[$dbName];
    }
}