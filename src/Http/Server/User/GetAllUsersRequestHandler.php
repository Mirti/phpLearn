<?php
declare(strict_types=1);

namespace Learn\Http\Server\User;

use Learn\Http\RequestInterface;
use Learn\Http\Server\RequestHandlerInterface;

class GetAllUsersRequestHandler implements RequestHandlerInterface
{
    /**
     * Method for handling response
     *
     * @param RequestInterface $request
     */
    public function handle(RequestInterface $request)
    {
        echo "GET ALL";
    }
}