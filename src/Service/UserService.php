<?php

declare (strict_types=1);

namespace Learn\Service;

use Learn\Model\User;
use Learn\Database\PdoConnection;

class UserService
{
    public static function createUser(User $user)
    {
        $pdo = PdoConnection::getInstance()->getConnection();

        $firstName = $user->getFirstName();
        $lastName  = $user->getLastName();

        $sql = "INSERT INTO users (firstName, lastName) VALUES (?, ?)";
        echo $pdo->prepare($sql)->execute([$firstName, $lastName]);
    }

    public static function getUsers()
    {
        $pdo  = PdoConnection::getInstance()->getConnection();
        $sql  = "SELECT * FROM users";
        $stmt = $pdo->query($sql);

        $jsonArray = array();

        while ($row = $stmt->fetch()) {
            array_push($jsonArray, $row);
        }
        echo json_encode($jsonArray);
    }
}