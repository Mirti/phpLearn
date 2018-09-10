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