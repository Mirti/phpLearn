<?php
declare(strict_types=1);

namespace Learn\Model\Value;


class LastName implements ValueInterface
{

    /** @var string */
    protected $lastName;

    /**
     * FirstName constructor.
     * @param string $lastName
     */
    public function __construct(string $lastName)
    {
        if (strlen($lastName) < 2 || strlen($lastName) > 32) {
            throw new \InvalidArgumentException("Wrong User Last Name");
        }

        $this->lastName = $lastName;
    }

    /**
     * @inheritdoc
     */
    public function toString(): string
    {
        return $this->lastName;
    }
}