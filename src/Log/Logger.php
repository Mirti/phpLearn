<?php
declare(strict_types=1);

namespace Learn\Log;


use Learn\Log\LogHandler\LogHandlerInterface;

class Logger implements LoggerInterface
{
    /** @var LogHandlerInterface[] */
    private $handlers;

    /**
     * Logger constructor.
     *
     * @param array $handlers
     */
    public function __construct(array $handlers)
    {
        $this->handlers = $handlers;
    }

    /**
     * @inheritdoc
     */
    public function emergency(string $message, array $context = [])
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * @inheritdoc
     */
    public function alert(string $message, array $context = [])
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    /**
     * @inheritdoc
     */
    public function critical(string $message, array $context = [])
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * @inheritdoc
     */
    public function error(string $message, array $context = [])
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    /**
     * @inheritdoc
     */
    public function warning(string $message, array $context = [])
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    /**
     * @inheritdoc
     */
    public function notice(string $message, array $context = [])
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    /**
     * @inheritdoc
     */
    public function info(string $message, array $context = [])
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    /**
     * @inheritdoc
     */
    public function debug(string $message, array $context = [])
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }

    /**
     * @inheritdoc
     */
    public function log(string $level, string $message, array $context = [])
    {
        $context['level']   = $level;
        $context['message'] = $message;
        $context['time']    = date("Y-m-d H:i:s");

        foreach ($this->handlers as $handler) {
            $handler->handle($context);
        }
    }
}