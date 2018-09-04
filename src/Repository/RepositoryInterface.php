<?php
declare(strict_types=1);

namespace Learn\Repository;


use Learn\Model\User;

interface RepositoryInterface
{
    /**
     * @param User $user
     */
    public function add(User $user): void;

    /**
     * @return array
     */
    public function getAll(): array;
}