<?php
declare(strict_types=1);

namespace Learn\Http\Middleware;


use Learn\Http\Message\Request\Handler\RequestHandlerInterface;
use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\ResponseInterface;

class Next implements RequestHandlerInterface
{

    private $fallbackHandler;
    private $queue;

    public function __construct(array $queue, RequestHandlerInterface $fallbackHandler)
    {
        $this->queue           = $queue;
        $this->fallbackHandler = $fallbackHandler;
    }


    public function handle(RequestInterface $request): ResponseInterface
    {
        if (!$this->queue) {
            return $this->fallbackHandler->handle($request);
        }
        $middleware = array_pop($this->queue);
        return $middleware->process($request, $this);
    }
}
