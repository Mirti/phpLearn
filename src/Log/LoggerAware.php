<?php
declare(strict_types=1);

namespace Learn\Log;


class LoggerAware implements LoggerAwareInterface
{

    /** @var */
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * @inheritdoc
     */
    public function setLogger(LoggerInterface $logger)
    {
        $logger->setTxtFile($this->getLogTxtFile());
    }

    /**
     * @inheritdoc
     */
    private function getLogTxtFile()
    {
        $file = fopen($this->config['dir'] . '/' . $this->config['fileName'], 'a+');

        if (!$file) {
            throw new \Exception("Can not open or create log file");
        }

        return $file;
    }
}