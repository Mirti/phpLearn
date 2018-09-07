<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request;


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
    public function getId(): string;
}