<?php
declare(strict_types=1);

namespace Learn\Repository\Exception;


use Learn\Model\Value\ValueObjectInterface;

class UserNotFoundException extends \Exception
{
    /**
     * @param ValueObjectInterface $id
     * @param \Throwable|null      $previous
     *
     * @return UserNotFoundException
     */
    public static function byId(ValueObjectInterface $id, \Throwable $previous = null): self
    {
        return new static("User with id ($id) could not be found", 404, $previous);
    }
}

