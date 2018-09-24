<?php
declare(strict_types=1);

namespace Learn\Http\Middleware\DbMiddleware;


use Learn\Database\PdoConnection;

class TransactionMiddleware
{
    /** @var PdoConnection */
    private $connection;

    /**
     * TransactionMiddleware constructor.
     * @param PdoConnection $connection
     */
    public function __construct(PdoConnection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Begin database transactions
     */
    public function beginTransaction()
    {
        $this->connection->beginTransaction();
    }

    /**
     * Commit database transaction
     */
    public function commitTransaction()
    {
        $this->connection->commit();
    }

    /**
     * RollBack database transaction
     */
    public function rollBackTransaction()
    {
        $this->connection->rollBack();
    }
}