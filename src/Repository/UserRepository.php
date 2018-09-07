<?php
declare(strict_types=1);

namespace Learn\Repository;


use Learn\Repository\Exception\UserNotFoundException;
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
     * @return User
     */
    public function find(string $id): User
    {
        $stmt = $this->connection->query("SELECT * FROM users WHERE id =\"$id\"");

        if(!$stmt)
        {
            throw new \Exception("Can not find user. Database failure: " . $this->connection->errorInfo());
        }

        $userData = $stmt->fetch(\PDO::FETCH_ASSOC);

        if(empty($userData)){
            throw UserNotFoundException::byId($id);
        }

        $user = new User($id, $userData['firstName'], $userData['lastName']);

        return $user;
    }
}