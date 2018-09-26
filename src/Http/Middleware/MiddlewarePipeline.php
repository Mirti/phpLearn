<?php
declare(strict_types=1);

namespace Learn\Http\Middleware;


use Learn\Http\Message\Request\Handler\RequestHandlerInterface;
use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\ResponseInterface;

class MiddlewarePipeline implements RequestHandlerInterface{
    /** @var array  */
    private $pipeline;

    /**
     * MiddlewarePipeline constructor.
     * @param array $pipeline
     */
    public function __construct(array $pipeline)
    {
        $this->pipeline = $pipeline;
    }

    public function handle(RequestInterface $request) : ResponseInterface
    {
        if (!$this->pipeline) {
            throw new \Exception("Not defined middleware", 500);
        }

        $nextHandler = clone $this;
        $middleware = array_pop($this->pipeline);

        return $middleware->process($request, $nextHandler);
    }

    public function process(RequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $next = new Next($this->pipeline, $handler);
        return $next->handle($request);
    }
}