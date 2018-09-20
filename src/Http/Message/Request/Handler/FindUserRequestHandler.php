<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Log\ContextCreator;
use Learn\Log\LoggerAwareTrait;
use Learn\Log\LoggerInterface;
use Learn\Model\Value\UserId;
use Learn\Repository\Exception\ApiException;
use Learn\Repository\Exception\UserNotFoundException;
use Learn\Repository\UserRepositoryInterface;

class FindUserRequestHandler implements RequestHandlerInterface
{
    use LoggerAwareTrait;

    /** @var UserRepositoryInterface */
    private $repository;

    /**
     * FindUserRequestHandler constructor.
     *
     * @param UserRepositoryInterface $repository
     * @param LoggerInterface         $logger
     */
    public function __construct(UserRepositoryInterface $repository, $logger)
    {
        $this->repository = $repository;

        $this->setLogger($logger);
    }

    /**
     * @inheritdoc
     * @throws ApiException
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        try {
            $id   = $request->getRouteParams()[':id'];
            $user = $this->repository->find(UserId::fromString($id));

            return new HttpResponse(200, $user->toArray());

        } catch (UserNotFoundException $ex) {
            throw new ApiException($ex->getMessage(), 404, $ex);

        } catch (\Throwable $ex) {
            $context = ContextCreator::createContext($request, $ex);
            $this->logger->error($ex->getMessage(), $context);
        }
    }
}