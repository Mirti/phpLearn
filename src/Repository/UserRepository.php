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
     * @return false|string
     * @throws \Exception
     */
    public function add(User $user): array
    {
        $uuid = Uuid::uuid4();
        $sql = "INSERT INTO users (id, firstName, lastName) VALUES (?, ?, ?)";

        $isAdded = $this->connection->prepare($sql)->execute([
            $uuid,
            $user->getFirstName(),
            $user->getLastName()
        ]);

        if (!$isAdded) {
            throw new \Exception("Can not add user. Database failure: " . $this->connection->errorInfo());
        }

        $insertedUser = ["id"        => $uuid->toString(),
                         "firstName" => $user->getFirstName(),
                         "lastName"  => $user->getLastName()];
        return $insertedUser ?? [];
    }

    /**
     * @inheritdoc
     */
    public function getAll(): array
    {
        $stmt = $this->connection->query("SELECT * FROM users");

        while ($row = $stmt->fetchAll(\PDO::FETCH_ASSOC)) {
            $users[] = $row;
        }

        return $users ?? [];
    }
}