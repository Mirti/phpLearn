<?php
declare(strict_types=1);

namespace Learn\Model\Value;


class LastName implements ValueObjectInterface
{

    /** @var string */
    protected $lastName;

    /** @var int */
    private const MIN_LAST_NAME_LENGTH = 2;
    /** @var int */
    private const MAX_LAST_NAME_LENGTH = 32;

    /**
     * FirstName constructor.
     * @param string $lastName
     */
    public function __construct(string $lastName)
    {
        if (strlen($lastName) < self::MIN_LAST_NAME_LENGTH
            || strlen($lastName) > self::MAX_LAST_NAME_LENGTH
            || ctype_lower(substr($lastName, 0, 1))) {
            throw new \InvalidArgumentException();
        }

        $this->lastName = $lastName;
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return (string)$this->lastName;
    }

    /**
     * @inheritdoc
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if ($this->lastName == $valueObject->__toString()) {
            return true;
        }
        return false;
    }
}