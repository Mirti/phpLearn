<?php
declare(strict_types=1);

namespace Learn\Http;


class HttpResponse implements ResponseInterface
{
    /** @var int  */
    private $statusCode;
    /** @var String  */
    private $reasonPhrase;

    /**
     * HttpResponse constructor.
     * @param int    $statusCode
     * @param String $reasonPhrase
     */
    public function __construct(int $statusCode, String $reasonPhrase)
    {
        $this->statusCode   = $statusCode;
        $this->reasonPhrase = $reasonPhrase;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        // TODO: Implement getStatusCode() method.
    }

    /**
     * @return mixed
     */
    public function getReasonPhrase()
    {
        // TODO: Implement getReasonPhrase() method.
    }

    /**
     * @return mixed
     */
    public function getProtocolVersion()
    {
        // TODO: Implement getProtocolVersion() method.
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        // TODO: Implement getHeaders() method.
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getHeader($name)
    {
        // TODO: Implement getHeader() method.
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        // TODO: Implement getBody() method.
    }
}