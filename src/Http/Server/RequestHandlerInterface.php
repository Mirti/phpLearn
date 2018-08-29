<?php
declare(strict_types = 1);

namespace Learn\Http\Server;

use Learn\Http\RequestInterface;

interface RequestHandlerInterface{
    public function handle(RequestInterface $request);
}