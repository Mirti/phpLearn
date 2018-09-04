<?php
declare(strict_types=1);

namespace Test\Unit\Repository;


use Learn\Model\User;
use Learn\Repository\RepositoryInterface;

class UserRepository implements RepositoryInterface
{

    protected $users =[];
    /**
     * @param User $user
     */
    public function add(User $user): void
    {
        $this->users[] = $user;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        // TODO: Implement getAll() method.
    }

    /**
     * @return array
     */
    public function fetchAll(){
        return $this->users;
    }
}
