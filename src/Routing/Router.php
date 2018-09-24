<?php
declare (strict_types=1);

namespace Learn\Routing;


use Learn\Http\Message\Request\Handler\Factory\HandlerFactory;
use Learn\Http\Message\Request\Handler\RequestHandlerInterface;
use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Middleware\DefaultMiddleware;
use Learn\Http\Middleware\MiddlewareInterface;

class Router
{
    /** @var array */
    private $config;

    /**
     * Router constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Method for matching request to proper class
     *
     * @param RequestInterface $request
     *
     * @return MiddlewareInterface
     */
    public function match(RequestInterface $request): MiddlewareInterface
    {
        $method = $request->getMethod();
        $route  = $request->getRoute();

        if (!isset($this->config[$route][$method])) {
            throw new \Exception("Missing handler for $method $route");
        }

        $handlerClass = $this->config[$route][$method];
        $handler      = HandlerFactory::create($handlerClass);

        if (!$handler instanceof RequestHandlerInterface) {
            throw new \Exception('Class must implement ' . RequestHandlerInterface::class);
        }

        $middlewareClass = $this->config[$route][$method]['middleware'];
        if(isset($middlewareClass)){
            $middleware = new $middlewareClass();
        } else{
            $middleware = new DefaultMiddleware();
        }

        return new $middlewareClass();
    }
}