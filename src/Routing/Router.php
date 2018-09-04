<?php
declare (strict_types=1);

namespace Learn\Routing;


use Learn\Http\Message\Request\Handler\RequestHandlerInterface;
use Learn\Http\Message\Request\RequestInterface;
use Learn\Repository\RepositoryFactory;

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

        $handlerClass = $this->config[$target][$method];
        $repository = RepositoryFactory::makeRepository($target);
        $handler      = new $handlerClass($repository);

        if (!$handler instanceof RequestHandlerInterface) {
            throw new \InvalidArgumentException('Class must implement ' . RequestHandlerInterface::class);
        }

        return $handler;
    }
}