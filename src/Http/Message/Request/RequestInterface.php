<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request;


use Learn\Http\Message\MessageInterface;

interface RequestInterface extends MessageInterface
{
    /**
     * @return string
     */
    public function getRemoteAddress(): string;

    /**
     * @return string
     */
    public function getMethod(): string;

    /**
     * @return string
     */
    public function getUrl(): string;

    /**
     * @return string
     */
    public function getRoute(): string;

    /**
     * @return array
     */
    public function getRouteParams(): array;
}