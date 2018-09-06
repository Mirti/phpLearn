<?php
declare(strict_types=1);

namespace Learn\Repository;


use Learn\Model\User;
use Rhumsaa\Uuid\Uuid;

interface RepositoryInterface
{
    /**
     * @param User $user
     * @param Uuid $uuid
     * @return array
     */
    public function add(User $user, $uuid);

    /**
     * @return array
     */
    public function fetchAll(): array;

    /**
     * @param Uuid $uuid
     * @return array
     */
    public function find(Uuid $uuid): array;
}