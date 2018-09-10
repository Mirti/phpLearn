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
        $sql = "INSERT INTO users (id, firstName, lastName) VALUES (:id, :firstName, :lastName)";

        $isAdded = $this->connection->prepare($sql)->execute(array(
            ':id'        => $user->getId(),
            ':firstName' => $user->getFirstName(),
            ':lastName'  => $user->getLastName()
        ));

        if (!$isAdded) {
            throw new \Exception("Can not add user. Database failure: " . $this->connection->errorInfo());
        }
    }

    /**
     * @inheritdoc
     */
    public function fetchAll(): array
    {
        $stmt = $this->connection->query("SELECT id, firstName, lastName FROM users WHERE deleted_at IS NULL");

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
        $sql = "SELECT * FROM users WHERE id =:id AND deleted_at IS NULL";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute(array(
            ':id' => $id
        ));

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
        $sql = "UPDATE users SET firstName = :firstName, lastName = :lastName WHERE id = :id";

        $isUpdated = $this->connection->prepare($sql)->execute(array(
                ':id'        => $user->getId(),
                ':firstName' => $user->getFirstName(),
                ':lastName'  => $user->getLastName()
            )

        );

        if (!$isUpdated) {
            throw new \Exception("Can not add user. Database failure: " . $this->connection->errorInfo());
        }
    }

    /**
     * @param User $user
     */
    public function delete(User $user)
    {
        $currentDate = date("Y-m-d H:i:s");

        $sql = "UPDATE users SET deleted_at = :currentDate WHERE id = :id";

        $isDeleted = $this->connection->prepare($sql)->execute(array(
            ':id'          => $user->getId(),
            ':currentDate' => $currentDate
        ));

        if (!$isDeleted) {
            throw new \Exception("Can not add user. Database failure: " . $this->connection->errorInfo());
        }

    }

}