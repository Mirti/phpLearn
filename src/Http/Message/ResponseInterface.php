<?php
declare(strict_types=1);

namespace Learn\Http\Message;


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