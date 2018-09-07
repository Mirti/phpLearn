<?php
declare (strict_types=1);

namespace Learn\Routing;


use Learn\Http\Message\Request\Handler\Factory\HandlerFactory;
use Learn\Http\Message\Request\Handler\RequestHandlerInterface;
use Learn\Http\Message\Request\RequestInterface;

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
     * @return RequestHandlerInterface
     */
    public function match($request): RequestHandlerInterface
    {
        $method = $request->getMethod();
        $target = $request->getTarget();

        if (!isset($this->config[$target][$method])) {
            throw new \InvalidArgumentException("Missing handler for $method $target");
        }

        var_dump($test = $this->toRoute($this->config, $request->getTarget()));
        $handlerClass = $this->config[$target][$method];
        $handler      = HandlerFactory::create($handlerClass);

        if (!$handler instanceof RequestHandlerInterface) {
            throw new \InvalidArgumentException('Class must implement ' . RequestHandlerInterface::class);
        }

        return $handler;
    }

    public function toRoute(array $routes, string $url): string
    {
        $routeParts = $routes;

        $urlParts = explode('/', $url);

        foreach ($routes as $route => $methods){
            foreach ($routeParts as $i => $part){
                if(!($part === $urlParts[$i]) && !(strpos($part,':')===0)){
                    continue;
                }
            }
        }

        return $route ?? '';
    }


}