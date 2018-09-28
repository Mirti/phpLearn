<?php
declare(strict_types=1);

namespace Learn\Http\Middleware;


use Learn\Http\Message\Request\Handler\RequestHandlerInterface;
use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Routing\Router;

class DefaultMiddleware implements MiddlewareInterface
{

    /** @var Router */
    private $router;

    /**
     * DefaultMiddleware constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @param RequestInterface        $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $requestHandler = $this->router->match($request);
        return $requestHandler->handle($request);
    }
}