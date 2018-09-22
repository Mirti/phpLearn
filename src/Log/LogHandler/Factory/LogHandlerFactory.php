<?php
declare(strict_types=1);

namespace Learn\Log\LogHandler\Factory;


use Learn\Repository\Exception\LoggerException;

class LogHandlerFactory
{
    /**
     * @param array $handlersConfig
     * @return array
     * @throws LoggerException
     */
    public static function create(array $handlersConfig): array
    {
        $logObjects = array();
        try {
            foreach ($handlersConfig as $handler => $config) {
                $formatterClass  = $config['formatter']['class'];
                $formatterParams = $config['formatter']['params'];

                $formatter = new $formatterClass($formatterParams);

                $handlerClass  = $config['handler']['class'];
                $handlerParams = $config['handler']['params'];

                $newHandler = new $handlerClass($formatter, $handlerParams);

                $logObjects[] = $newHandler;
            }
            return $logObjects;
        } catch (\Throwable $ex) {
            throw new LoggerException('Logger Configuration Error');
        }
    }
}