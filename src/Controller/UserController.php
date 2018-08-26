<?php
declare (strict_types=1);

namespace Learn\Controller;

use Learn\Service\UserService;
use Learn\Model\User;

class UserController{

    public static function checkHttpMethod(){
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method){

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

    public static function getUsers(){
        return UserService::getUsers();
    }

    public static function addUser(){
       $data = json_decode(file_get_contents('php://input'),true);
       $user = new User($data["firstName"], $data['lastName']);
       return UserService::addUser($user);
    }
}


