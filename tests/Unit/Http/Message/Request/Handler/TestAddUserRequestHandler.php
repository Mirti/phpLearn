<?php

class TestAddUserRequestHandler extends PHPUnit\Framework\TestCase
{

    protected $request;
    protected $examplePdo;
    protected $userRepository;

    public function setUp()
    {
        $body             = [
            "firstName" => "userFirstName",
            "lastName"  => "userLastName"
        ];
        $this->request    = new \Learn\Http\Message\Request\HttpRequest("/users", "POST", $body);
        $this->examplePdo = new \Learn\Database\PdoConnection([]);

        $mockPdo = $this->getMockBuilder(\Learn\Database\Factory\PdoConnectionFactory::class)
            ->setMethods(['create'])
            ->getMock()
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->examplePdo);


        $mockUserRepository = $this->getMockBuilder(\Learn\Repository\UserRepository::class)
            ->setMethods(['add'])
            ->getMock()
            ->expects($this->once())
            ->method('create')
            ->with([new User]);

        $this->userRepository = $mockUserRepository;
    }

    /** @test */
    public function handleAddNewUserReturnResponseCreated()
    {
        $addUserHandler = new \Learn\Http\Message\Request\Handler\AddUserRequestHandler();

        $response = $addUserHandler->handle($this->request);

        assertEquals(201, $response->getCode());
    }

}