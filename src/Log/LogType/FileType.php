<?php
declare(strict_types=1);

namespace Learn\Log\LogType;


use Learn\Log\LogLevel;
use Learn\Log\LogType\Formatter\JsonFormatter;
use Learn\Log\LogType\Formatter\TextFormatter;

class FileType implements LogTypeInterface
{
    /** @var */
    private $fileDir;
    /** @var */
    private $fileName;
    /** @var */
    private $fileExtension;
    /** @var bool|resource */
    private $file;

    /**
     * TxtLogType constructor.
     * @param $config
     * @throws \Exception
     */
    public function __construct($config)
    {
        if (!self::isConfigValid($config)) {
            throw new \Exception("Invalid log file configuration");
        }

        $this->fileDir       = $config['fileDir'];
        $this->fileName      = $config['fileName'];
        $this->fileExtension = $config['fileExtension'];

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

        fwrite($this->file, self::format($logValue, $this->fileExtension));
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
            throw new \Exception("Can not open or create log file");
        }

        return $file;
    }

    private static function format($array, $extension)
    {
        switch ($extension) {
            case 'txt':
                return TextFormatter::format($array);
                break;
            case 'html':
                return JsonFormatter::format($array);
                break;

            default:
                throw new \Exception("Invalid Logger Configuration");
        }
    }

    private static function isConfigValid($config): bool
    {
        if (empty($config['fileDir']) || empty($config['fileName'] || empty($config['fileExtension']))) {
            return false;
        }
        return true;
    }

}