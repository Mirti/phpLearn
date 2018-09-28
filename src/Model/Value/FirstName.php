<?php
declare(strict_types=1);

namespace Learn\Model\Value;


use Assert\Assertion;

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
        Assertion::minLength($firstName, self::MIN_FIRST_NAME_LENGTH);
        Assertion::maxLength($firstName, self::MAX_FIRST_NAME_LENGTH);

        $this->firstName = ucfirst($firstName);
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return $this->firstName;
    }

    /**
     * @inheritdoc
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        return $this->firstName === $valueObject->__toString();
    }
}