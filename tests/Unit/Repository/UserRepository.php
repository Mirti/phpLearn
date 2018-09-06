<?php
declare(strict_types=1);

namespace Test\Unit\Repository;


use Learn\Model\User;
use Learn\Repository\RepositoryInterface;

class UserRepository implements RepositoryInterface
{

    protected $users = [];

    /**
     * @param User $user
     * @return array
     */
    public function add(User $user): array
    {
        $this->users[] = $user;
        return [$user->getFirstName(),
                $user->getLastName()];
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
    public function fetchAll()
    {
        return $this->users;
    }
}
