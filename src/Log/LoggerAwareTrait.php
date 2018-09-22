<?php
declare(strict_types=1);

namespace Learn\Log;


trait LoggerAwareTrait
{
    /** @var LoggerInterface */
    protected $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}