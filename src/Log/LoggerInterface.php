<?php
declare(strict_types=1);

namespace Learn\Log;


use Learn\Http\Message\Request\RequestInterface;

interface LoggerInterface
{
    /**
     * @param \Throwable       $ex
     * @param RequestInterface $request
     * @return bool
     */
    public function addLog(\Throwable $ex, RequestInterface $request): bool;
}