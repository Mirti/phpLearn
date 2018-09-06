<?php
declare(strict_types=1);

namespace Test\Unit\Repository;


use Learn\Model\User;
use Learn\Repository\RepositoryInterface;
use Rhumsaa\Uuid\Uuid;

class UserRepository implements RepositoryInterface
{

    protected $users = [];

    /**
     * @param User $user
     * @param Uuid $uuid
     * @return array|void
     */
    public function add(User $user, $uuid)
    {
        $this->users[] = ["firstName" => $user->getFirstName(),
                          "lastName"  => $user->getLastName(),
                          "id"        => $uuid];
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
