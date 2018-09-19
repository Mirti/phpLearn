<?php
declare(strict_types=1);

namespace Learn\Log;


class Logger implements LoggerInterface
{
    /** @var */
    private $config;
    /** @var */
    private $txtFileName;
    /** @var */
    private $txtFileDir;
    /** @var */
    private $txtFile;
    /** @var */
    private $jsonFileName;
    /** @var */
    private $jsonFileDir;
    /** @var */
    private $jsonFile;
    /** @var */
    private $consoleEnabled;

    /**
     * Logger constructor.
     * @param $config
     * @throws \Exception
     */
    public function __construct($config)
    {
        $this->config = $config;

        $this->txtFileDir  = $config['txtFileDir'];
        $this->txtFileName = $config['txtFileName'];

        $this->jsonFileDir  = $config['jsonFileDir'];
        $this->jsonFileName = $config['jsonFileName'];

        $this->consoleEnabled = $config['console'];

        $this->setUp();
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
        $logValue['Log Level'] = strtoupper(LogLevel::EMERGENCY);
        $logValue['Date']      = date("Y-m-d H:i:s");
        $logValue['message']   = $message;

        if ($this->consoleEnabled) {
            error_log(print_r($logValue, TRUE));
        }

        if (isset($this->txtFile)) {
            fwrite($this->txtFile, $this->toString($logValue));
        }

        if (isset($this->jsonFile)) {
            fwrite($this->jsonFile, json_encode($logValue));
        }
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
        $logValue['Log Level'] = $level;
        $logValue['Date']      = date("Y-m-d H:i:s");
        $logValue['ID']        = $context['id'];
        $logValue['Method']    = $context['method'];
        $logValue['URL']       = $context['url'];
        $logValue['Code']      = $context['code'];
        $logValue['Message']   = $message;
        $logValue['File']      = $context['file'];
        $logValue['Line']      = $context['line'];

        if ($this->consoleEnabled) {
            error_log(print_r($logValue, TRUE));
        }

        if (isset($this->txtFile)) {
            fwrite($this->txtFile, $logValue);
        }

        if (isset($this->jsonFile)) {
            fwrite($this->jsonFile, json_encode($logValue));
        }
    }

    /**
     * @throws \Exception
     */
    private function setUp()
    {
        if (!empty($this->txtFileDir) && !empty($this->txtFileName)) {
            $this->txtFile = $this->getLogTxtFile($this->txtFileDir, $this->txtFileName);
        }

        if (!empty($this->jsonFileDir) && !empty($this->jsonFileName)) {
            $this->jsonFile = $this->getLogTxtFile($this->jsonFileDir, $this->jsonFileName);
        }
    }

    /**
     * @param $fileDir
     * @param $fileName
     * @return bool|resource
     * @throws \Exception
     */
    private function getLogTxtFile($fileDir, $fileName)
    {
        $file = fopen($fileDir . '/' . $fileName, 'a+');

        if (!$file) {
            throw new \Exception("Can not open or create log file");
        }

        return $file;
    }

    /**
     * @param array $array
     * @return string
     */
    private function toString(array $array): string
    {
        return implode(" | ", $array) . "\n";
    }

}