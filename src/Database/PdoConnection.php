<?php
declare (strict_types=1);

namespace Learn\Database;


final class PdoConnection extends \PDO
{
    /**
     * PdoConnection constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $dsn = $config['driver'] . ":";

        foreach ($config['dsn'] as $key => $value) {
            $dsn .= "$key=$value;";
        }

        $credentials = $config['credentials'];

        parent::__construct($dsn, $credentials['username'], $credentials['password'], []);
    }
}
