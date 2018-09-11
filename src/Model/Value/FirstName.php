<?php
declare(strict_types=1);

namespace Learn\Model\Value;


class FirstName implements ValueObjectInterface
{

    /** @var string */
    protected $firstName;

    /** @var int */
    private const MIN_FIRST_NAME_LENGTH = 2;
    /** @var int */
    private const MAX_FIRST_NAME_LENGTH = 32;

    /**
     * FirstName constructor.
     * @param string $firstName
     */
    public function __construct(string $firstName)
    {
        if (strlen($firstName) < self::MIN_FIRST_NAME_LENGTH
            || strlen($firstName) > self::MAX_FIRST_NAME_LENGTH
            || ctype_lower(substr($firstName, 0, 1))) {
            throw new \InvalidArgumentException();
        }
        $this->firstName = $firstName;
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return (string)$this->firstName;
    }

    /**
     * @inheritdoc
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if ($this->firstName == $valueObject->__toString()) {
            return true;
        }
        return false;
    }
}