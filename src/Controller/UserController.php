<?php
declare (strict_types=1);

namespace Learn\Controller;

use Learn\Service\UserService;

class UserController{

    public static function checkHttpMethod(){
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method){

            case "GET":
                self::getUsers();
                break;

            case "POST":
                echo "POST";
               // self::addUser();
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
        return UserService::addUser();
    }
}


