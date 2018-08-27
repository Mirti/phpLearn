<?php
declare (strict_types=1);

namespace Learn\Controller;


use Learn\Service\UserService;
use Learn\Model\User;
use \Throwable;

class UserController
{
    /**
     * @param null $id
     * Method for checking request method and choose proper method
     */
    public static function checkHttpMethod($id = null): void
    {
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method) {
            case "GET":
                if ($id == null) {
                    self::getUsers();
                } else {
                    self::getUser($id);
                }

                break;

            case "POST":
                self::addUser();
                break;

            case "PUT":
                self::updateUser();
                break;

            case "DELETE":
                self::deleteUser($id);
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
     * @param $id
     *
     * Controller method to get one user
     */
    public static function getUser($id): void
    {
        if (UserService::getUser($id)) {
            header('HTTP/1.1 200 OK');
        }
    }

    /**
     * Controller method to add new user
     */
    public static function addUser(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);

        try {
            $user = new User($data["firstName"], $data['lastName']);
        } catch (Throwable $ex) {
            badRequestError();
        }

        if (UserService::addUser($user)) {
            header('HTTP/1.1 201 Created');
        }
    }

    /**
     * @param $id
     *
     * Controller method for deleting user
     */
    public static function deleteUser($id): void
    {
        if (UserService::deleteUser($id)) {
            header('HTTP/1.1 200 OK');
        }
    }

    /**
     * @param $id
     *
     * Controller method for updating user
     */
    public static function updateUser($id): void
    {
        $data = json_decode(file_get_contents('php://input'), true);

        try {
            $user = new User($data["firstName"], $data['lastName']);
        } catch (Throwable $ex) {
            badRequestError();
        }

        if (UserService::updateUser($id, $user)) {
            header('HTTP/1.1 201 Created');
        }
    }
}


