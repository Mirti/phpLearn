<?php
declare(strict_types=1);

namespace Learn\Log\LogHandler;


use Learn\Log\Formatter\FormatterInterface;
use Learn\Log\LogLevel;
use Learn\Repository\Exception\LoggerException;

class FileHandler implements LogHandlerInterface
{
    /** @var string */
    private $dir;
    /** @var string */
    private $name;
    /** @var string */
    private $ext;
    /** @var FormatterInterface */
    private $formatter;
    /** @var bool|resource */
    private $file;

    /**
     * FileHandler constructor.
     * @param FormatterInterface $formatter
     * @param array              $config
     * @throws LoggerException
     */
    public function __construct(FormatterInterface $formatter, array $config)
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
    function log($level, string $message, array $context = array()): void
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
     * @param string $dir
     * @param string $name
     * @param string $ext
     * @return bool|resource
     * @throws LoggerException
     */
    private static function getFile(string $dir, string $name, string $ext)
    {
        $file = fopen($dir . '/' . $name . '.' . $ext, 'a+');

        if (!$file) {
            throw new LoggerException("Can not open or create log file");
        }
        return $file;
    }

    /**
     * @param array $config
     * @return bool
     */
    function isConfigValid(array $config): bool
    {
        if (!empty($config['dir']) && !empty($config['name']) && !empty(($config)['ext'])) {
            return true;
        }
        return false;
    }
}