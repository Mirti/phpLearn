<?php
declare(strict_types=1);

namespace Learn\Http\Message;


interface MessageInterface
{
    /**
     * @return array
     */
    public function getBody(): array;
}