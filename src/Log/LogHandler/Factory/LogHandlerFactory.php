<?php
declare(strict_types=1);

namespace Learn\Log\LogHandler\Factory;


use Learn\Log\LogHandler\ConsoleHandler;
use Learn\Log\LogHandler\FileHandler;
use Learn\Repository\Exception\LoggerException;

class LogHandlerFactory
{
    /**
     * @param $handlers
     * @return array
     * @throws LoggerException
     */
    public static function create($handlers)
    {
        $logObjects = array();
        try {
            foreach ($handlers as $handler => $objects) {
                switch ($handler) {
                    case 'file':
                        foreach ($objects as $object => $config) {
                            $logObjects[] = new FileHandler(
                                $config['fileDir'],
                                $config['fileName'],
                                $config['fileExtension'],
                                $config['contentFormatter']);
                        }
                        break;

                    case 'console':
                        foreach ($objects as $object => $config) {
                            $logObjects[] = new ConsoleHandler($config['contentFormatter']);
                            break;
                        }
                }
            }
            return $logObjects;
        } catch (\Throwable $ex) {
            throw new LoggerException("Invalid logger configuration");
        }
    }
}