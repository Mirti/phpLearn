<?php
declare(strict_types=1);

namespace Learn\Repository;


use Learn\Model\User;
use Learn\Repository\Exception\UserNotFoundException;

class UserRepository implements UserRepositoryInterface
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
     * @inheritdoc
     */
    public function add(User $user): void
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
     * @inheritdoc
     */
    public function find(string $id): User
    {
        $stmt = $this->connection->query("SELECT * FROM users WHERE id =\"$id\"");

        if (!$stmt) {
            throw new \Exception("Can not find user. Database failure: " . $this->connection->errorInfo());
        }

        $userData = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (empty($userData)) {
            throw UserNotFoundException::byId($id);
        }

        $user = new User($id, $userData['firstName'], $userData['lastName']);

        return $user;
    }

    /**
     * @inheritdoc
     */
    public function update(User $user)
    {
        if (empty($this->find($user->getId()))) {
            throw UserNotFoundException::byId($user->getId());
        }

        $sql = "UPDATE users SET firstName = ?, lastName = ? WHERE id = ?";

        $isUpdated = $this->connection->prepare($sql)->execute([
            $user->getFirstName(),
            $user->getLastName(),
            $user->getId()
        ]);

        if (!$isUpdated) {
            throw new \Exception("Can not add user. Database failure: " . $this->connection->errorInfo());
        }
    }

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function delete(string $id)
    {
        if (empty($this->find($id))) {
            throw UserNotFoundException::byId($id);
        }

        $sql = "DELETE FROM users WHERE id = ?";

        $isDeleted = $this->connection->prepare($sql)->execute([$id]);

        if (!$isDeleted) {
            throw new \Exception("Can not add user. Database failure: " . $this->connection->errorInfo());
        }

    }

}