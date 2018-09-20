<?php
declare(strict_types=1);

namespace Learn\Log\LogType;


use Learn\Log\LogLevel;

interface LogTypeInterface
{
    /**
     * LogTypeInterface constructor.
     * @param $config
     */
    function __construct($config);

    /**
     * @param LogLevel $level
     * @param string   $message
     * @param array    $context
     * @return void
     */
    function log($level, $message, array $context = array()): void;
}