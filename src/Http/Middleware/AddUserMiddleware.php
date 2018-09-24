<?php
declare(strict_types=1);

namespace Learn\Http\Middleware;


use Learn\Http\Message\Request\Handler\RequestHandlerInterface;
use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Http\Middleware\UserApiMiddleware\BodyKeysValidator;
use Learn\Repository\Exception\ApiException;

class AddUserMiddleware implements MiddlewareInterface
{

    /**
     * @param RequestInterface        $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $body = $request->getBody();

        if (!BodyKeysValidator::isValid($body)) {
            throw new ApiException('Missing one of required field.', 400);
        }

        $additionalKeys = AdditionalKeysValidator::getAdditionalKeys($body);

        if ($additionalKeys) {
            throw new ApiException('Too many arguments: ' . implode(',', $additionalKeys), 400);
        }

        $handler->handle($request);
    }
}