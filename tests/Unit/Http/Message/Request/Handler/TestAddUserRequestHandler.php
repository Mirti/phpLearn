<?php
declare(strict_types=1);

namespace Test\Unit\Http\Message\Request\Handler;


use Learn\Http\Message\Request\Handler\AddUserRequestHandler;
use Test\Unit\Repository\UserUserRepository;

class TestAddUserRequestHandler extends \PHPUnit\Framework\TestCase
{
    /**
     * @var
     */
    protected $request;
    /**
     * @var
     */
    protected $userRepository;

    /**
     * Setup test class
     */
    public function setUp()
    {
        $body          = [
            "firstName" => "userFirstName",
            "lastName"  => "userLastName"
        ];
        $this->request = new \Learn\Http\Message\Request\HttpRequest("/users", "POST", $body);

        $this->userRepository = new UserUserRepository();
    }

    /** @test */
    public function handleAddNewUserReturnResponseCreated()
    {
        $handler  = new AddUserRequestHandler($this->userRepository);
        $response = $handler->handle($this->request);

        self::assertEquals("userFirstName", $response->getBody()["firstName"]);
        self::assertEquals('userLastName', $response->getBody()['lastName']);
        self::assertEquals(201, $response->getCode());
    }

}