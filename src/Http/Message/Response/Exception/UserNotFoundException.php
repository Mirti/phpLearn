<?php
declare(strict_types=1);

namespace Learn\Http\Message\Response\Exception;


class UserNotFoundException extends \Exception
{
    /**
     * UserNotFoundException constructor.
     * @param string          $message
     * @param int             $code
     * @param \Exception|null $previous
     */
    public function __construct($message = "User Not Found", $code = 404, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

