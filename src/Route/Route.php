<?php
declare(strict_types=1);

namespace Learn\Route;


use Learn\Controller\UserController;

class Route
{
    /**
     * @param String $path
     *
     * Method for routing to proper controllers according to path
     */
    public static function route(String $path): void
    {
        switch ($path) {

            case "/":
                echo self::getInfo();
                break;

            case "/user" :
                UserController::checkHttpMethod();
                break;

            default:
                notFoundError();
        }
    }

    /**
     * @return string
     *
     * Method for setting example info in index.php
     */
    static function getInfo(): string
    {
        header('HTTP/1.1 200 OK');
        return "REST API działające już: <br />
             /user  GET <br />
             /user  POST <br /> <br />";
    }
}