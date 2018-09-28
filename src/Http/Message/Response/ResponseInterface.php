<?php
declare(strict_types=1);

namespace Learn\Http\Message\Response;


use Learn\Http\Message\MessageInterface;

interface ResponseInterface extends MessageInterface
{
    /**
     * @return int
     */
    public function getCode(): int;
}