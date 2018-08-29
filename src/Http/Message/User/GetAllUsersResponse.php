<?php
declare (strict_types=1);

namespace Learn\Http\Message\User;


use Learn\Http\Message\ResponseInterface;

class GetAllUsersResponse implements ResponseInterface
{

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
}