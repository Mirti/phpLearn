<?php
declare(strict_types=1);

namespace Learn\Http;


class HttpResponse implements ResponseInterface
{
    /** @var int */
    private $statusCode;
    /** @var String */
    private $reasonPhrase;
    /** @var */
    private $protocolVersion;
    /** @var array */
    private $headers;
    /** @var */
    private $body;

    /**
     * HttpResponse constructor.
     * @param int    $statusCode
     * @param string $body
     * @param string $reasonPhrase
     * @param string $protocolVersion
     * @param array  $headers
     */
    public function __construct(int $statusCode, $body = "", string $reasonPhrase = "", string $protocolVersion = "1.1", $headers = [])
    {
        $this->statusCode      = $statusCode;
        $this->reasonPhrase    = $reasonPhrase;
        $this->protocolVersion = $protocolVersion;
        $this->headers         = $headers;
        $this->body            = $body;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function getReasonPhrase(): string
    {
        return $this->reasonPhrase;
    }

    /**
     * @return string
     */
    public function getProtocolVersion(): string
    {
        return $this->protocolVersion;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getHeader($name)
    {
        if (!in_array($name, $this->headers)) {
            return "";
        } else {
            return $this->headers[$name];
        }
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $header
     * @param string $value
     * @return mixed
     */
    public function withHeader(string $header, string $value)
    {
        $this->headers[$header] = $value;
    }

    /**
     * Method for creating HTTP response from this object
     */
    public function makeResponse()
    {
        if (empty($this->reasonPhrase)) {
            http_response_code($this->statusCode);
        } else {
            header("HTTP/$this->protocolVersion  $this->statusCode  $this->reasonPhrase");
        }

        if (isset($this->headers)) {
            foreach ($this->headers as $header => $value) {
                header("$header:$value");
            }
        }
        echo $this->body;
    }
}