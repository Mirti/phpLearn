<?php

class TestAddUserRequestHandler extends PHPUnit\Framework\TestCase
{
    protected $request;
    protected $userRepository;

    public function setUp()
    {
        $body          = [
            "firstName" => "userFirstName",
            "lastName"  => "userLastName"
        ];
        $this->request = new \Learn\Http\Message\Request\HttpRequest("/users", "POST", $body);

        $mockUserRepository = $this->getMockBuilder(\Learn\Repository\UserRepository::class)
            ->disableOriginalConstructor()
            ->setMethods(["add"])
            ->getMock();

        $this->userRepository = $mockUserRepository;
    }

    /** @test */
    public function handleAddNewUserReturnResponseCreated()
    {
        $addUserHandler = new \Learn\Http\Message\Request\Handler\AddUserRequestHandler($this->userRepository);

        $response = $addUserHandler->handle($this->request);

        assertEquals(201, $response->getCode());
    }

}