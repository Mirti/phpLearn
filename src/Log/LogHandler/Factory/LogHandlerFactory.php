<?php
declare(strict_types=1);

namespace Learn\Log\LogHandler\Factory;


use Learn\Repository\Exception\LoggerException;

class LogHandlerFactory
{
    /**
     * @param $handlersConfig
     * @return array
     * @throws LoggerException
     */
    public static function create($handlersConfig)
    {
        $logObjects = array();

        foreach ($handlersConfig as $handler => $config) {
            $logObjects[] = new $config['handler']($config);
        }
        return $logObjects;
    }
}