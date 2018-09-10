<?php
declare(strict_types=1);

namespace Learn\Model;


class User
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $firstName;

    /** @var string */
    protected $lastName;

    /**
     * User constructor.
     *
     * @param string $id
     *
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(string $id, string $firstName, string $lastName)
    {
        $this->id = $id;

        $this->firstName = $firstName;
        $this->lastName  = $lastName;
    }
    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,

            'first_name' => $this->firstName,
            'last_name'  => $this->lastName
        ];
    }
}