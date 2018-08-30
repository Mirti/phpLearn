<?php
declare(strict_types=1);

namespace Learn\Http\Server;


use Learn\Http\RequestInterface;

interface RequestHandlerInterface
{

    /**
     * @param RequestInterface $request
     * @return mixed
     */
    public function handle(RequestInterface $request);
}