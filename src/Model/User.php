<?php
declare(strict_types=1);

namespace Learn\Model;


class User
{
    /** @var string */
    protected $firstName;
    /** @var string */
    protected $lastName;

    /**
     * User constructor.
     *
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(string $firstName, string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName  = $lastName;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }
}