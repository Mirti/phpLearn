<?php
declare(strict_types=1);

namespace Learn\Repository;


use Learn\Model\User;

interface RepositoryInterface
{
    /**
     * @param User $user
     * @return array
     */
    public function add(User $user): array;

    /**
     * @return array
     */
    public function getAll(): array;
}