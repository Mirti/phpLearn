<?php
declare(strict_types=1);

namespace Learn\Http\Middleware\UserApiMiddleware;


use Learn\Http\Message\Request\Handler\RequestHandlerInterface;
use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Http\Middleware\MiddlewareInterface;
use Learn\Repository\Exception\ApiException;

class AdditionalKeysValidator implements MiddlewareInterface
{

    /**
     * @param RequestInterface        $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $additionalKeys = array_diff(array_keys($request->getBody()), ['firstName', 'lastName']);

        if ($additionalKeys) {
            throw new ApiException('Too many arguments: ' . implode(',', $additionalKeys), 400);
        }
        return $handler->handle($request);
    }
}