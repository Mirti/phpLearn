<?php
declare(strict_types=1);

namespace Learn\Http;


class HttpRequest implements RequestInterface
{
    /** @var */
    private $target;
    /** @var */
    private $method;
    /** @var */
    private $body;
    /** @var */
    private $protocolVersion;

    /**
     * HttpRequest constructor.
     */
    public function __construct()
    {
        $this->target          = $_SERVER['REQUEST_URI'];
        $this->method          = $_SERVER['REQUEST_METHOD'];
        $this->body            = file_get_contents('php://input');
        $this->protocolVersion = $_SERVER['SERVER_PROTOCOL'];
    }

    /**
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return mixed
     */
    public function getProtocolVersion()
    {
        return $this->protocolVersion;
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        $headers = array();

        foreach ($_SERVER as $name => $value) {
            $headers[$name] = $value;
        }

        return $headers;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getHeader($name)
    {
        $header = $_SERVER[$name];
        if (!isset($header)) {
            throw new \HttpHeaderException();
        }
        return $header;
    }

    /**
     * @param string $header
     * @param string $value
     * @return mixed|void
     */
    public function withHeader($header, $value)
    {
        $_SERVER[$header]=$value;
    }
}