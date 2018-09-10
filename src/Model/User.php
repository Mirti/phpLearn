<?php
declare(strict_types=1);

namespace Learn\Model;


use Learn\Model\Value\FirstName;
use Learn\Model\Value\Id;
use Learn\Model\Value\LastName;

class User
{
    /** @var Id */
    protected $id;

    /** @var FirstName */
    protected $firstName;

    /** @var LastName */
    protected $lastName;

    /**
     * User constructor.
     * @param Id        $id
     * @param FirstName $firstName
     * @param LastName  $lastName
     */
    public function __construct(Id $id, FirstName $firstName, LastName $lastName)
    {
        $this->id = $id;

        $this->firstName = $firstName;
        $this->lastName  = $lastName;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return FirstName
     */
    public function getFirstName(): FirstName
    {
        return $this->firstName;
    }

    /**
     * @return LastName
     */
    public function getLastName(): LastName
    {
        return $this->lastName;
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