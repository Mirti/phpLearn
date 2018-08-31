<?php
declare(strict_types=1);

namespace Learn\Http;


use Learn\Http\Message\MessageInterface;

interface ResponseInterface extends MessageInterface
{

    /**
     * @return mixed
     */
    public function getStatusCode();

    /**
     * @return mixed
     */
    public function getReasonPhrase();
}