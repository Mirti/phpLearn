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
    public function match(RequestInterface $request): RequestHandlerInterface
    {
        $method = $request->getMethod();
        $route  = $request->getRoute();
        if (!isset($this->config[$route][$method]['handler'])) {
            throw new \Exception("Missing handler for $method $route");
        }
        $handlerClass = $this->config[$route][$method]['handler'];
        $handler      = HandlerFactory::create($handlerClass);
        if (!$handler instanceof RequestHandlerInterface) {
            throw new \Exception('Class must implement ' . RequestHandlerInterface::class);
        }
        return $handler;
    }
}