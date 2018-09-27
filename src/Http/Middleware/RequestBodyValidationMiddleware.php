<?php
declare(strict_types=1);

namespace Learn\Http\Middleware;


use Learn\Http\Message\Request\Handler\RequestHandlerInterface;
use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Http\Middleware\Validator\ValidatorInterface;
use Learn\Repository\Exception\ApiException;

class RequestBodyValidationMiddleware
{
    /** @var */
    private $validators;

    /**
     * @param array $validators
     */
    public function __constructor(array $validators)
    {
        $this->validators = $validators;
    }

    /**
     * @param RequestInterface        $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $route = $request->getRoute();

        /** @var ValidatorInterface $validator */
        $validator = $this->validators[$route];

        if (!$validator) {

            return $handler->handle($request);
        }

        try {

            $validator->validate($request);
        } catch (ApiException $ex) {
            return new HttpResponse(400, [$ex->getMessage()]);

        }

        return $handler->handle($request);
    }
}