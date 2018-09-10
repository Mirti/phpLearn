<?php
declare(strict_types=1);

namespace Learn\Model\Value;


class FirstName implements ValueInterface
{

    /** @var string */
    protected $firstName;

    /**
     * FirstName constructor.
     * @param string $firstName
     */
    public function __construct(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @inheritdoc
     */
    public function toString(): string
    {
        return $this->firstName;
    }
}