<?php
declare(strict_types=1);

namespace Learn\Repository\Exception;


use Throwable;

class ApiException extends \Exception
{
    /** @var */
    protected $message;
    /** @var */
    protected $code;
    /** @var */
    protected $exception;

    /**
     * ApiException constructor.
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}