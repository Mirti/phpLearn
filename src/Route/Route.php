<?php
declare(strict_types=1);

namespace Learn\Route;


use Learn\Controller\UserController;

class Route
{
    public static function route(String $path)
    {
        switch ($path) {

            case "/user" :
                UserController::checkHttpMethod();
                break;

            default:
                return "404 NOT FOUND";
        }

    }
}