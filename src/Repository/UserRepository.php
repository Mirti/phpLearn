<?php
declare(strict_types=1);

namespace Learn\Repository;


use Learn\Model\User;
use Rhumsaa\Uuid\Uuid;

class UserRepository implements RepositoryInterface
{
    /** @var \PDO */
    private $connection;

    /**
     * Repository constructor.
     *
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param User $user
     * @param      $uuid
     * @return array
     * @throws \Exception
     */
    public function add(User $user, $uuid)
    {
        $sql = "INSERT INTO users (id, firstName, lastName) VALUES (?, ?, ?)";

        $isAdded = $this->connection->prepare($sql)->execute([
            $uuid,
            $user->getFirstName(),
            $user->getLastName()
        ]);

        if (!$isAdded) {
            throw new \Exception("Can not add user. Database failure: " . $this->connection->errorInfo());
        }
    }

    /**
     * @inheritdoc
     */
    public function fetchAll(): array
    {
        $stmt = $this->connection->query("SELECT * FROM users");

        while ($row = $stmt->fetchAll(\PDO::FETCH_ASSOC)) {
            $users[] = $row;
        }

        return $users ?? [];
    }

    /**
     * @param Uuid $uuid
     * @return array
     */
    public function find(Uuid $uuid): array
    {
        $stmt = $this->connection->query("SELECT * FROM users WHERE id =\"$uuid\"");
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}