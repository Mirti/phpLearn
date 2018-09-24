<?php
declare(strict_types=1);

namespace Learn\Log\LogHandler;


interface LogHandlerInterface
{
    /**
     * @param array $log
     */
    function handle(array $log): void;
}