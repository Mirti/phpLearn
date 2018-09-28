<?php
declare(strict_types=1);

namespace Learn\Repository\Exception;


use Throwable;

class LoggerException extends \Exception
{
    /**
     * LoggerException constructor.
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "Logger Error", int $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}