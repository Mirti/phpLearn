<?php
declare(strict_types=1);

namespace Test\Unit\Repository;


use Learn\Model\User;
use Learn\Repository\UserRepositoryInterface;
use Rhumsaa\Uuid\Uuid;

class UserUserRepository implements UserRepositoryInterface
{

    protected $users = [];

    /**
     * @param User $user
     * @return array|void
     */
    public function add(User $user): void
    {
        $this->users[] = [
            "id" => $user->getId(),

            "firstName" => $user->getFirstName(),
            "lastName"  => $user->getLastName(),
        ];
    }

    /**
     * @return array
     */
    public function fetchAll(): array
    {
        return $this->users;
    }

    /**
     * @param Uuid $uuid
     * @return array
     */
    public function find(Uuid $uuid): array
    {
        return $this->users[0];  //To muszę poprawić, znaleźć sposób, żeby szukało tego, w ktorym się uuid zgadza
    }
}
