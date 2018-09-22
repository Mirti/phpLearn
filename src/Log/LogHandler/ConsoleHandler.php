<?php
declare(strict_types=1);


namespace Learn\Log\LogHandler;


use Learn\Log\Formatter\FormatterInterface;
use Learn\Log\LogLevel;
use Learn\Repository\Exception\LoggerException;

class ConsoleHandler implements LogHandlerInterface
{
    /** @var  FormatterInterface */
    private $formatter;

    /**
     * ConsoleHandler constructor.
     * @param $formatter
     * @param $config
     * @throws LoggerException
     */
    public function __construct($formatter, $config)
    {
        $this->formatter = $formatter;

        if (!$this->isConfigValid($config)) {
            throw new LoggerException("Logger configuration error");
        }

    }

    /**
     * @param LogLevel $level
     * @param string   $message
     * @param array    $context
     * @return void
     */
    function log($level, $message, array $context = array()): void
    {
        $logValue['Log Level'] = $level;
        $logValue['Date']      = date("Y-m-d H:i:s");
        $logValue['Message']   = $message;

        foreach ($context as $key => $value) {
            $logValue[$key] = $value;
        }
        error_log(print_r($this->formatter->format($logValue), TRUE));
    }

    /**
     * @param $config
     * @return bool
     */
    function isConfigValid($config): bool
    {
        if (isset($this->formatter)) {
            return true;
        }
        return false;
    }
}