<?php
declare(strict_types=1);

namespace Learn\Model\Value;


class LastName
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
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }
}