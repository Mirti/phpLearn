<?php
declare(strict_types=1);

namespace Learn\Model\Value;


use Assert\Assertion;

class LastName implements ValueObjectInterface
{
    /** @var string */
    protected $lastName;

    /** @var int */
    private const MIN_LAST_NAME_LENGTH = 2;
    /** @var int */
    private const MAX_LAST_NAME_LENGTH = 32;

    /**
     * LastName constructor.
     * @param string $lastName
     */
    public function __construct(string $lastName)
    {
        Assertion::minLength($lastName, self::MIN_LAST_NAME_LENGTH);
        Assertion::maxLength($lastName, self::MAX_LAST_NAME_LENGTH);

        $this->lastName = ucfirst($lastName);
    }

    /**
     * @inheritdoc
     */
    public function __toString(): string
    {
        return $this->lastName;
    }

    /**
     * @inheritdoc
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        return $this->lastName === $valueObject->__toString();
    }
}