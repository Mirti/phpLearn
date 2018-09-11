<?php
declare(strict_types=1);

namespace Learn\Model;


use Learn\Model\Value\FirstName;
use Learn\Model\Value\LastName;
use Learn\Model\Value\UserId;

class User
{
    /** @var UserId */
    protected $id;

    /** @var FirstName */
    protected $firstName;

    /** @var LastName */
    protected $lastName;

    /**
     * User constructor.
     * @param UserId    $id
     * @param FirstName $firstName
     * @param LastName  $lastName
     */
    public function __construct(UserId $id, FirstName $firstName, LastName $lastName)
    {
        $this->id = $id;

        $this->firstName = $firstName;
        $this->lastName  = $lastName;
    }

    /**
     * @return UserId
     */
    public function getUserId(): UserId
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
     * @param FirstName $firstName
     */
    public function setFirstName(FirstName $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return LastName
     */
    public function getLastName(): LastName
    {
        return $this->lastName;
    }

    /**
     * @param LastName $lastName
     */
    public function setLastName(LastName $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function equals(User $user): bool
    {
        foreach (get_class_vars(self::class) as $property => $value) {
            if (!$this->$property === $user->$property) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id->__toString(),

            'first_name' => $this->firstName->__toString(),
            'last_name'  => $this->lastName->__toString()
        ];
    }
}