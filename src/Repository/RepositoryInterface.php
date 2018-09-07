<?php
declare(strict_types=1);

namespace Learn\Repository;


use Learn\Model\User;
use Rhumsaa\Uuid\Uuid;

interface RepositoryInterface
{
    /**
     * @param User $user
     * @return array
     */
    public function add(User $user);

    /**
     * @return array
     */
    public function fetchAll(): array;

    /**
     * @param string $id
     * @return User
     */
    public function find(string $id): User;
}