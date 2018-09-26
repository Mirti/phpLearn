<?php
declare(strict_types=1);

namespace Learn\Http\Middleware;


use Learn\Http\Message\Request\Handler\RequestHandlerInterface;
use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\ResponseInterface;
use SplQueue;

class MiddlewarePipeline implements RequestHandlerInterface
{
    /** @var SplQueue */
    private $pipeline;

    /**
     * MiddlewarePipeline constructor.
     */
    public function __construct()
    {
        $this->pipeline = new SplQueue();
    }


    public function __clone()
    {
        $this->pipeline = clone $this->pipeline;
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws \Exception
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        if ($this->pipeline->isEmpty()) {
            throw new \Exception("Not defined middleware", 500);
        }

        $nextHandler = clone $this;
        $middleware  = $nextHandler->pipeline->dequeue();

        return $middleware->process($request, $nextHandler);
    }

    /**
     * @param RequestInterface        $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $next = new Next($this->pipeline, $handler);
        return $next->handle($request);
    }

    /**
     * @param MiddlewareInterface $middleware
     */
    public function pipe(MiddlewareInterface $middleware): void
    {
        $this->pipeline->enqueue($middleware);
    }
}