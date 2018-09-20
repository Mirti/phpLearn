<?php
declare(strict_types=1);

namespace Learn\Log\LogType;


use Learn\Log\LogLevel;

class TxtLogType implements LogTypeInterface
{
    /** @var */
    private $fileDir;
    /** @var */
    private $fileName;
    /** @var bool|resource */
    private $file;

    /**
     * TxtLogType constructor.
     * @param $config
     * @throws \Exception
     */
    public function __construct($config)
    {
        $this->fileDir  = $config['fileDir'];
        $this->fileName = $config['fileName'];

        $this->file = self::getLogTxtFile($this->fileDir, $this->fileName);
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
        $logValue['ID']        = $context['id'];
        $logValue['Method']    = $context['method'];
        $logValue['URL']       = $context['url'];
        $logValue['Code']      = $context['code'];
        $logValue['Message']   = $message;
        $logValue['File']      = $context['file'];
        $logValue['Line']      = $context['line'];

        fwrite($this->file, self::toString($logValue));
    }

    /**
     * @param $fileDir
     * @param $fileName
     * @return bool|resource
     * @throws \Exception
     */
    private static function getLogTxtFile($fileDir, $fileName)
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
    private static function toString(array $array): string
    {
        return implode(" | ", $array) . "\n";
    }
}