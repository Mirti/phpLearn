<?php
declare(strict_types=1);

namespace Learn\Log;


trait LoggerAwareTrait
{
    /** @var LoggerInterface */
    protected $logger;

    /**
     * @inheritdoc
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param \Learn\Http\Message\Request\RequestInterface $request
     * @param \Throwable $exception
     * @return array
     */
    function createContext($request, $exception): array
    {
        $context['id']     = $request->getRemoteAddress();
        $context['method'] = $request->getMethod();
        $context['url']    = $request->getUrl();
        $context['code']   = $exception->getCode();
        $context['file']   = $exception->getFile();
        $context['line']   = $exception->getLine();

        return $context;
    }

}