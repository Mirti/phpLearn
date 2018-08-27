<?php

declare (strict_types=1);

namespace Learn\Service;


use Learn\Model\User;
use Learn\Database\PdoConnection;

class UserService
{
    /**
     * @param User $user
     * @return bool
     *
     * Method for add new user to database
     */
    public static function addUser(User $user): bool
    {
        if (!empty($pdo)) {
            $firstName = $user->getFirstName();
            $lastName  = $user->getLastName();

            $sql = "INSERT INTO users (firstName, lastName) VALUES (?, ?)";
            $pdo->prepare($sql)->execute([$firstName, $lastName]);
            return true;
        }
        return false;
    }

    /**
     * @return bool
     *
     * Method for showing all users form database
     */
    public static function getUsers(): bool
    {
        $pdo = PdoConnection::getInstance()->getConnection();
        if (!empty($pdo)) {
            $sql  = "SELECT * FROM users";
            $stmt = $pdo->query($sql);

            $jsonArray = array();

            while ($row = $stmt->fetch()) {
                array_push($jsonArray, $row);
            }
            echo json_encode($jsonArray);
            return true;
        }
        return false;
    }

    /**
     * @param $id
     * @return bool
     *
     * Method for getting single user from database
     */
    public static function getUser($id): bool
    {
        $pdo = PdoConnection::getInstance()->getConnection();

        if (!empty($pdo)) {
            if (self::isInDb($id)) {
                $sql  = "SELECT * FROM users WHERE id = $id";
                $stmt = $pdo->query($sql);
                echo json_encode($stmt->fetch());
                return true;
            } else {
                notFoundError();
            }
            return false;
        }
    }

    /**
     * @param $id
     * @return bool
     *
     * Method for deleting user from database
     */
    public static function deleteUser($id)
    {
        $pdo = PdoConnection::getInstance()->getConnection();
        if (!empty($pdo)) {
            if (self::isInDb($id)) {
                $sql = "DELETE FROM users WHERE id = ?";
                $pdo->prepare($sql)->execute([$id]);
                return true;
            } else {
                notFoundError();
            }
            return false;
        }
    }

    /**
     * @param $id
     * @return bool
     *
     * Method for checking is User in database
     */
    private static function isInDb($id)
    {
        $pdo = PdoConnection::getInstance()->getConnection();
        if (!empty($pdo)) {
            $sql  = "SELECT * FROM users WHERE id = $id";
            $stmt = $pdo->query($sql);
            if (!empty($stmt->fetch())) {
                return true;
            }
        }
        return false;
    }
}
