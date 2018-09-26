<?php
declare(strict_types=1);

namespace Learn\Http\Middleware;


use Learn\Http\Message\Request\Handler\RequestHandlerInterface;
use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\ResponseInterface;
use SplQueue;

class Next implements RequestHandlerInterface
{
    /** @var RequestHandlerInterface */
    private $fallbackHandler;
    /** @var SplQueue */
    private $queue;

    /**
     * Next constructor.
     * @param SplQueue                $queue
     * @param RequestHandlerInterface $fallbackHandler
     */
    public function __construct(SplQueue $queue, RequestHandlerInterface $fallbackHandler)
    {
        $this->queue           = clone $queue;
        $this->fallbackHandler = $fallbackHandler;
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        if (!$this->queue->isEmpty()) {
            return $this->fallbackHandler->handle($request);
        }

        $middleware = $this->queue->dequeue();

        return $middleware->process($request, $this);
    }
}
