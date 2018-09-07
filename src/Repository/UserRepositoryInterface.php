<?php
declare(strict_types=1);

namespace Learn\Repository;


use Learn\Model\User;

interface UserRepositoryInterface
{
    /**
     * @param User $user
     */
    public function add(User $user): void;

    /**
     * @return User[]
     */
    public function fetchAll(): array;

    /**
     * @param string $id
     *
     * @return User
     */
    public function find(string $id): User;
}