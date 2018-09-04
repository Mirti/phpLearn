<?php
declare(strict_types=1);

namespace Test\Unit\Http\Message\Request\Handler;


use Learn\Http\Message\Request\Handler\AddUserRequestHandler;
use Learn\Model\User;
use Test\Unit\Repository\UserRepository;

class TestAddUserRequestHandler extends \PHPUnit\Framework\TestCase
{
    protected $request;
    protected $userRepository;

    public function setUp()
    {
        $body          = [
            "first_name" => "userFirstName",
            "last_name"  => "userLastName"
        ];
        $this->request = new \Learn\Http\Message\Request\HttpRequest("/users", "POST", $body);

        $this->userRepository = new UserRepository();
    }

    /** @test */
    public function handleAddNewUserReturnResponseCreated()
    {
        $handler  = new AddUserRequestHandler($this->userRepository);
        $response = $handler->handle($this->request);

        $user = new User('userFirstName', 'userLastName');

        self::assertEquals($user, $this->userRepository->fetchAll()[0]);
        self::assertEquals(201, $response->getCode());
    }

}