<?php
declare(strict_types=1);

namespace Learn\Log;


class Logger implements LoggerInterface
{
    /** @var */
    private $config;
    /** @var */
    private $txtFile;

    /**
     * Logger constructor.
     * @param $config
     * @throws \Exception
     */
    public function __construct($config)
    {
        $this->config  = $config;
        $this->txtFile = $this->getLogTxtFile();
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function emergency($message, array $context = array())
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function alert($message, array $context = array())
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function critical($message, array $context = array())
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function error($message, array $context = array())
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function warning($message, array $context = array())
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function notice($message, array $context = array())
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function info($message, array $context = array())
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function debug($message, array $context = array())
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed  $level
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function log($level, $message, array $context = array())
    {
        $logValue = "\n \n";
        $logValue .= "Log Level: " . $level . " ";
        $logValue .= $currentDate = date("Y-m-d H:i:s") . "  ";
        $logValue .= $context['id'] . "  ";
        $logValue .= "[" . $context['method'] . "]  ";
        $logValue .= $context['url'] . "  ";
        $logValue .= "[" . $context['code'] . "]  ";
        $logValue .= $message . "  ";
        $logValue .= "(" . $context['file'] . " " . $context['line'];

        fwrite($this->txtFile, $logValue);
    }

    private function getLogTxtFile()
    {
        $file = fopen($this->config['dir'] . '/' . $this->config['fileName'], 'a+');

        if (!$file) {
            throw new \Exception("Can not open or create log file");
        }

        return $file;
    }
}