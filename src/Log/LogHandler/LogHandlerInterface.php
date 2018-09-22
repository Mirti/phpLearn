<?php
declare(strict_types=1);

namespace Learn\Log\LogHandler;


use Learn\Log\Formatter\FormatterInterface;
use Learn\Log\LogLevel;

interface LogHandlerInterface
{
    /**
     * LogHandlerInterface constructor.
     * @param FormatterInterface $formatter
     * @param array              $config
     */
    function __construct(FormatterInterface $formatter, array $config);

    /**
     * @param LogLevel $level
     * @param string   $message
     * @param array    $context
     * @return void
     */
    function log($level, string $message, array $context = array()): void;

    /**
     * @param array $config
     * @return bool
     */
    function isConfigValid(array $config): bool;
}