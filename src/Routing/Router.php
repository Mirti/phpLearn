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
        /**
         * [0] - ""
         * [1] - handler name
         * [2] - parameter
         */
        $target = explode("/", $request->getTarget());

        $targetName = $target[1];
        @$targetId = $target[2];

        if (!isset($this->config[$targetName][$method])) {
            throw new \InvalidArgumentException("Missing handler for $method $targetName");
        }

        if (!empty($targetId)) {
            $targetName .= "/";
        }

        $handlerClass = $this->config[$targetName][$method];
        $handler      = HandlerFactory::create($handlerClass, $targetId);

        if (!$handler instanceof RequestHandlerInterface) {
            throw new \InvalidArgumentException('Class must implement ' . RequestHandlerInterface::class);
        }

        return $handler;
    }
}