<?php
declare(strict_types=1);

namespace Learn\Log\LogHandler;


use Learn\Log\Formatter\FormatterInterface;
use Learn\Log\LogLevel;
use Learn\Repository\Exception\LoggerException;

class FileHandler implements LogHandlerInterface
{
    /** @var */
    private $fileDir;
    /** @var */
    private $fileName;
    /** @var */
    private $fileExtension;
    /** @var FormatterInterface */
    private $contentFormatter;
    /** @var bool|resource */
    private $file;

    /**
     * FileHandler constructor.
     * @param $config
     * @throws \Exception
     */
    public function __construct($config)
    {
        if (!$this->isConfigValid($config)) {
            throw new LoggerException("Logger configuration error");
        }

        $this->fileDir          = $config['fileDir'];
        $this->fileName         = $config['fileName'];
        $this->fileExtension    = $config['fileExtension'];
        $this->contentFormatter = $config['contentFormatter'];

        $this->file = self::getFile($this->fileDir, $this->fileName, $this->fileExtension);
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

        fwrite($this->file, $this->contentFormatter::format($logValue));
    }

    /**
     * @param $fileDir
     * @param $fileName
     * @param $fileExtension
     * @return bool|resource
     * @throws \Exception
     */
    private static function getFile($fileDir, $fileName, $fileExtension)
    {
        $file = fopen($fileDir . '/' . $fileName . '.' . $fileExtension, 'a+');

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
        if (!empty($config['fileDir']) && !empty($config['fileName']) && !empty(($config)['fileExtension'])) {
            return true;
        }
        return false;
    }
}