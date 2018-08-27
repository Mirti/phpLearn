<?php
declare (strict_types=1);

namespace Learn\Controller;


use Learn\Service\UserService;
use Learn\Model\User;

class UserController
{

    /**
     * Method for checking request method and choose proper method
     */
    public static function checkHttpMethod(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method) {
            case "GET":
                self::getUsers();
                break;

            case "POST":
                self::addUser();
                break;

            case "PUT":
                break;

            case "DELETE":
                break;
        }
    }

    /**
     * Controller method to get all users
     */
    public static function getUsers(): void
    {

        if (UserService::getUsers()) {
            header('HTTP/1.1 200 OK');
        }
    }

    /**
     * Controller method to add new user
     */
    public static function addUser(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $user = new User($data["firstName"], $data['lastName']);
        if (UserService::addUser($user)) {
            header('HTTP/1.1 201 Created');
        }
    }
}


