<?php
declare(strict_types=1);

namespace Learn\Http;


interface RequestInterface
{

    /**
     * @return string
     */
    public function getRequestTarget(): string;

    /**
     * @return string
     */
    public function getRequestMethod(): string;

    /**
     * @return string
     */
    public function getRequestBody(): string;
}