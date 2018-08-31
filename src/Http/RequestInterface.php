<?php
declare(strict_types=1);

namespace Learn\Http;


use Learn\Http\Message\MessageInterface;

interface RequestInterface extends MessageInterface
{

    /**
     * @return string
     */
    public function getTarget(): string;

    /**
     * @return string
     */
    public function getMethod(): string;

    /**
     * @return string
     */
    public function getBody(): string;
}