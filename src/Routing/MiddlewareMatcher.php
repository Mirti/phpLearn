<?php
declare(strict_types=1);

namespace Learn\Routing;


use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Middleware\DefaultMiddleware;
use Learn\Http\Middleware\MiddlewareInterface;

class MiddlewareMatcher
{
    /** @var */
    private $config;

    /**
     * MiddlewareMatcher constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * @param RequestInterface $request
     * @return MiddlewareInterface
     */
    public function match(RequestInterface $request): MiddlewareInterface
    {
        $method = $request->getMethod();
        $route  = $request->getRoute();

        $middlewareClass = $this->config[$route][$method]['middleware'];

        if (!$middlewareClass) {
            $middlewareClass = DefaultMiddleware::class;
        }

        return new $middlewareClass();
    }
}