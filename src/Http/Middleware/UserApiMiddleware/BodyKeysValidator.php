<?php
declare(strict_types=1);

namespace Learn\Http\Middleware\UserApiMiddleware;


use Learn\Http\Message\Request\Handler\RequestHandlerInterface;
use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Http\Middleware\MiddlewareInterface;
use Learn\Repository\Exception\ApiException;

class BodyKeysValidator implements MiddlewareInterface
{
    /**
     * @param RequestInterface        $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $body = $request->getBody();

        if (!array_key_exists('firstName', $body) || !array_key_exists('lastName', $body)) {
            throw new ApiException("Missing one of required field", 400);
        }
        return $handler->handle($request);
    }
}