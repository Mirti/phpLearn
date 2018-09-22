<?php
declare(strict_types=1);

namespace Learn\Repository;


use Learn\Model\User;
use Learn\Model\Value\FirstName;
use Learn\Model\Value\LastName;
use Learn\Model\Value\UserId;
use Learn\Repository\Exception\UserNotFoundException;
use PDO;

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
        /**
         * TODO: make it global
         */
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO users (id, firstName, lastName) VALUES (:id, :firstName, :lastName)";

        $values = [
            ':id'        => $user->getUserId()->__toString(),
            ':firstName' => $user->getFirstName()->__toString(),
            ':lastName'  => $user->getLastName()->__toString()];

        $stm = $this->connection->query($sql);
        $stm->execute($values);
    }

    /**
     * @inheritdoc
     */
    public function fetchAll(): array
    {
        $stmt = $this->connection->query("SELECT id, firstName, lastName FROM users WHERE deleted_at IS NULL");

        if (!$stmt) {
            return [];
        }
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $users[] = new User(
                UserId::fromString($row['id']),
                new FirstName($row['firstName']),
                new LastName($row['lastName'])
            );
        }
        return $users ?? [];
    }

    /**
     * @inheritdoc
     */
    public function find(UserId $id): User
    {
        $sql = "SELECT * FROM users WHERE id =:id AND deleted_at IS NULL";

        $values = [
            ':id' => $id->__toString()
        ];

        $stmt = $this->connection->prepare($sql);

        $stmt->execute($values);

        if (!$stmt) {
            throw new \Exception("Can not find user. Database failure: " . $this->connection->errorInfo());
        }

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$result) {
            throw UserNotFoundException::byId($id);
        }

        $user = new User(
            UserId::fromString($result['id']),
            new FirstName($result['firstName']),
            new LastName($result['lastName']));

        return $user;
    }

    /**
     * @inheritdoc
     */
    public function update(User $user)
    {
        $sql = "UPDATE users SET firstName = :firstName, lastName = :lastName WHERE id = :id";

        $values = [
            ':id'        => $user->getUserId()->__toString(),
            ':firstName' => $user->getFirstName()->__toString(),
            ':lastName'  => $user->getLastName()->__toString()
        ];

        $isUpdated = $this->connection->prepare($sql)->execute($values);

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

        $values = [
            ':id'          => $user->getUserId()->__toString(),
            ':currentDate' => $currentDate
        ];

        $isDeleted = $this->connection->prepare($sql)->execute($values);

        if (!$isDeleted) {
            throw new \Exception("Can not add user. Database failure: " . $this->connection->errorInfo());
        }
    }
}