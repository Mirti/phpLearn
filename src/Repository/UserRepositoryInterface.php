<?php
declare(strict_types=1);

namespace Learn\Repository;


use Learn\Model\User;
use Learn\Model\Value\UserId;

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
     * @param UserId $id
     *
     * @return User
     */
    public function find(UserId $id): User;

    /**
     * @param User $user
     */
    public function update(User $user);

    /**
     * @param User $user
     */
    public function delete(User $user);
}