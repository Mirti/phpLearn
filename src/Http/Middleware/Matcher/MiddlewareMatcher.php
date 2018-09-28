<?php
declare(strict_types=1);

namespace Learn\Http\Middleware\Matcher;


use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Middleware\DefaultMiddleware;

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
     * @return array
     */
    public function match(RequestInterface $request): array
    {
        $method = $request->getMethod();
        $route  = $request->getRoute();

        $defaultMiddleware[]    = DefaultMiddleware::class;
        $additionalMiddleware = $this->config[$route][$method]['middleware'];

        if (!$additionalMiddleware) {
            return $defaultMiddleware;
        }

        return array_merge($defaultMiddleware, $additionalMiddleware);

    }
}