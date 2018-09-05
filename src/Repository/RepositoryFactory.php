<?php
declare(strict_types=1);

namespace Learn\Repository;


use Learn\Database\Factory\PdoConnectionFactory;

class RepositoryFactory
{
    /**
     * @param $target
     * @return RepositoryInterface
     */
    public static function makeRepository($target)
    {
        switch ($target) {
            case "/users":
                return new UserRepository(PdoConnectionFactory::create());
                break;
        }
    }
}