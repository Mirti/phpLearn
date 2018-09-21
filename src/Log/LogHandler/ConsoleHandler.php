<?php
declare(strict_types=1);


namespace Learn\Log\LogHandler;


use Learn\Log\Formatter\FormatterInterface;
use Learn\Log\LogLevel;

class ConsoleHandler implements LogHandlerInterface
{
    /** @var  FormatterInterface */
    private $contentFormatter;

    /**
     * ConsoleHandler constructor.
     * @param FormatterInterface $contentFormatter
     */
    public function __construct($contentFormatter)
    {
        $this->contentFormatter = $contentFormatter;
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
        error_log(print_r($this->contentFormatter::format($logValue), TRUE));
    }
}