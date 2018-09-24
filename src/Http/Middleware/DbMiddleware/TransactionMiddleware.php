<?php
declare(strict_types=1);

namespace Learn\Http\Middleware\DbMiddleware;


use Learn\Database\PdoConnection;

class TransactionMiddleware
{
    /**
     * Begin database transactions
     * @param PdoConnection $connection
     */
    public static function beginTransaction(PdoConnection $connection): void
    {
        $connection->beginTransaction();
    }

    /**
     * Commit database transaction
     * @param PdoConnection $connection
     */
    public static function commitTransaction(PdoConnection $connection)
    {
        $connection->commit();
    }

    /**
     * RollBack database transaction
     * @param PdoConnection $connection
     */
    public static function rollBackTransaction(PdoConnection $connection): void
    {
        $connection->rollBack();
    }
}