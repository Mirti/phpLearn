<?php
declare(strict_types=1);

namespace Learn\Log\LogHandler;


use Learn\Log\Formatter\FormatterInterface;
use Learn\Log\LogLevel;
use Learn\Repository\Exception\LoggerException;

class FileHandler implements LogHandlerInterface
{
    /** @var */
    private $dir;
    /** @var */
    private $name;
    /** @var */
    private $ext;
    /** @var FormatterInterface */
    private $formatter;
    /** @var bool|resource */
    private $file;

    /**
     * FileHandler constructor.
     * @param $formatter
     * @param $config
     * @throws LoggerException
     */
    public function __construct($formatter, $config)
    {
        if (!$this->isConfigValid($config)) {
            throw new LoggerException("Logger configuration error");
        }

        $this->dir       = $config['dir'];
        $this->name      = $config['name'];
        $this->ext       = $config['ext'];
        $this->formatter = $formatter;

        $this->file = self::getFile($this->dir, $this->name, $this->ext);
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

        fwrite($this->file, $this->formatter->format($logValue));
    }

    /**
     * @param $dir
     * @param $name
     * @param $ext
     * @return bool|resource
     * @throws LoggerException
     */
    private static function getFile($dir, $name, $ext)
    {
        $file = fopen($dir . '/' . $name . '.' . $ext, 'a+');

        if (!$file) {
            throw new LoggerException("Can not open or create log file");
        }
        return $file;
    }

    /**
     * @param $config
     * @return bool
     */
    function isConfigValid($config): bool
    {
        if (!empty($config['dir']) && !empty($config['name']) && !empty(($config)['ext'])) {
            return true;
        }
        return false;
    }
}