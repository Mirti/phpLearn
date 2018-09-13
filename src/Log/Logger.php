<?php
declare(strict_types=1);

namespace Learn\Log;


use Learn\Http\Message\Request\RequestInterface;

class Logger implements LoggerInterface
{
    /** @var  */
    private $config;
    /** @var bool|resource  */
    private $file;

    /**
     * Logger constructor.
     * @param $config
     * @throws \Exception
     */
    public function __construct($config)
    {
        $this->config = $config;
        $this->file   = $this->getLogFile();
    }

    /**
     * @inheritdoc
     */
    public function addLog(\Throwable $ex, RequestInterface $request): bool
    {
        $logValue = "\n \n";
        $logValue .= $currentDate = date("Y-m-d H:i:s") . "  ";
        $logValue .= $request->getRemoteAddress() . "  ";
        $logValue .= "[" . $request->getMethod() . "]  ";
        $logValue .= $request->getUrl() . "  ";
        $logValue .= "[" . $ex->getCode() . "]  ";
        $logValue .= $ex->getMessage() . "  ";
        $logValue .= "(" . $ex->getFile(). " " .$ex->getLine();

        fwrite($this->file, $logValue);
        return true;
    }


    /**
     * @return bool|resource
     * @throws \Exception
     */
    private function getLogFile()
    {
        $file = fopen($this->config['dir'] . '/' . $this->config['fileName'], 'a+');

        if (!$file) {
            throw new \Exception("Can not open or create log file");
        }

        return $file;
    }

}