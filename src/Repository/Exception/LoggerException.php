<?php
declare(strict_types=1);

namespace Learn\Repository\Exception;


use Throwable;

class LoggerException extends \Exception
{
    public function __construct(string $message = "Logger Error", int $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}