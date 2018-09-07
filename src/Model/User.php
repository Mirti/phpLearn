<?php
declare(strict_types=1);

namespace Learn\Model;


class User
{
    /** @var string */
    protected $firstName;
    /** @var string */
    protected $lastName;
    /** @var string */
    protected $id;

    /**
     * User constructor.
     *
     * @param string $firstName
     * @param string $lastName
     * @param string $id
     */
    public function __construct(string $id, string $firstName, string $lastName)
    {
        $this->id        = $id;
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

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return ["id"        => $this->id,
                "firstName" => $this->firstName,
                "lastName"  => $this->lastName];
    }
}