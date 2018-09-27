<?php
declare(strict_types=1);

namespace Learn\Http\Middleware;


use Learn\Http\Message\Request\Handler\RequestHandlerInterface;
use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Http\Middleware\Factory\MiddlewareFactory;

class MiddlewareRunner implements RequestHandlerInterface
{
    /** @var */
    private $middlewareObjects;

    /**
     * RequestRunner constructor.
     *
     * @param array $middlewares
     */
    public function __construct(array $middlewares)
    {
        foreach ($middlewares as $middlewareClass) {
            $this->middlewareObjects[] = MiddlewareFactory::create($middlewareClass);
        }
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        $middleware = array_pop($this->middlewareObjects);

        return $middleware->process($request, $this);
    }
}