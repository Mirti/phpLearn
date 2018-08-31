<?php
declare(strict_types=1);

namespace Learn\Http;


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