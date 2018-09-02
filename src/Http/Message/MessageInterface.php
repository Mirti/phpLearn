<?php
declare(strict_types=1);

namespace Learn\Http\Message;


interface MessageInterface
{

    /**
     * @return mixed
     */
    public function getProtocolVersion();

    /**
     * @return mixed
     */
    public function getHeaders();

    /**
     * @param $name
     * @return mixed
     */
    public function getHeader($name);

    /**
     * @return mixed
     */
    public function getBody();

    /**
     * @param string $header
     * @param string $value
     * @return mixed
     */
    public function withHeader(string $header, string $value);

}