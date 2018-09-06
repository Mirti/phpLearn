<?php
declare(strict_types=1);

namespace Learn\Repository\Exception;


class UserNotFoundException extends \Exception
{
    /**
     * @param string          $id
     * @param \Throwable|null $previous
     *
     * @return UserNotFoundException
     */
    public static function byId(string $id, \Throwable $previous = null): self
    {
        return new static("User with id ($id) could not be found", 404, $previous);
    }
}

