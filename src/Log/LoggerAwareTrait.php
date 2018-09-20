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

}