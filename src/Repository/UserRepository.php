<?php
declare(strict_types=1);

namespace Learn\Repository;


use Learn\Http\Message\Response\Exception\UserNotFoundException;
use Learn\Model\User;

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
     * @throws \Exception
     */
    public function add(User $user)
    {
        $sql = "INSERT INTO users (id, firstName, lastName) VALUES (?, ?, ?)";

        $isAdded = $this->connection->prepare($sql)->execute([
            $user->getId(),
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
     * @param string id
     * @return array
     */
    public function find(string $id): array
    {
        $stmt = $this->connection->query("SELECT * FROM users WHERE id =\"$id\"");

        if(!$stmt)
        {
            throw new \Exception("Can not find user. Database failure: " . $this->connection->errorInfo());
        }

        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if(empty($user)){
            throw new UserNotFoundException();
        }
        return $user;
    }
}