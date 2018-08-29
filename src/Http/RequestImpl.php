<?php
declare(strict_types=1);

class RequestImpl implements RequestInterface
{
    /** @var */
    private $requestTarget;
    /** @var */
    private $requestMethod;
    /** @var */
    private $requestBody;

    /**
     * RequestImpl constructor.
     */
    public function __construct()
    {
        $this->requestTarget = $_SERVER['REQUEST_URI'];
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->requestBody   = file_get_contents('php://input');
    }

    /**
     * @return string
     */
    public function getRequestTarget(): string
    {
        return $this->requestTarget;
    }

    /**
     * @return string
     */
    public function getRequestMethod(): string
    {
        return $this->getRequestMethod();
    }

    /**
     * @return string
     */
    public function getRequestBody(): string
    {
        return $this->requestBody;
    }
}