<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Http\Middleware\MiddlewarePipeline;
use Learn\Http\Middleware\UserModelMiddleware\AddUserMiddleware;
use Learn\Repository\UserRepositoryInterface;

class AddUserRequestHandler implements RequestHandlerInterface
{
    /** @var UserRepositoryInterface */
    private $repository;

    /** @var */
    private $middleware;

    /**
     * AddUserRequestHandler constructor.
     * @param UserRepositoryInterface $repository
     * @param                         $middleware
     */
    public function __construct(UserRepositoryInterface $repository, array $middleware)
    {
        $this->repository = $repository;
        $this->middleware = $middleware;
    }

    /**
     * @inheritdoc
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        $middlewarePipeline = new MiddlewarePipeline();

        foreach ($this->middleware as $middlewareClass) {
            $middleware = new $middlewareClass();
            $middlewarePipeline->pipe($middleware);
        }

        $middlewarePipeline->pipe(new AddUserMiddleware($this->repository));

        return $middlewarePipeline->handle($request);
    }
}