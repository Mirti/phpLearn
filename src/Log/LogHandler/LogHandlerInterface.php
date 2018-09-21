<?php
declare(strict_types=1);

namespace Learn\Log\LogHandler;


use Learn\Log\LogLevel;

interface LogHandlerInterface
{
    /**
     * @param LogLevel $level
     * @param string   $message
     * @param array    $context
     * @return void
     */
    function log($level, $message, array $context = array()): void;
}