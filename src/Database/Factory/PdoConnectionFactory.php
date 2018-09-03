<?php
declare(strict_types=1);

namespace Learn\Database\Factory;


use Learn\Database\PdoConnection;

class PdoConnectionFactory
{
    /**
     * @return PdoConnection
     */
    public static function create(): PdoConnection
    {
        $config = include($_SERVER['DOCUMENT_ROOT'] . "/config/local.php");

        return new PdoConnection($config['database']);
    }
}