<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;
use Learn\Log\LoggerAwareTrait;
use Learn\Log\LoggerInterface;
use Learn\Repository\UserRepositoryInterface;

class GetAllUsersRequestHandler implements RequestHandlerInterface
{
    use LoggerAwareTrait;

    /** @var UserRepositoryInterface */
    private $repository;

    /**
     * GetAllUserRequestHandler constructor.
     *
     * @param UserRepositoryInterface $repository
     * @param LoggerInterface         $logger
     */
    public function __construct($repository, $logger)
    {
        $this->repository = $repository;
        $this->setLogger($logger);
    }

    /**
     * @inheritdoc
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        try {
            $users      = $this->repository->fetchAll();
            $usersArray = array();

            foreach ($users as $user) {
                $usersArray[] = $user->toArray();
            }

            return new HttpResponse(200, $usersArray);

        } catch (\Throwable $ex) {
            $context = $this->createContext($request, $ex);
            $this->logger->error($ex->getMessage(), $context);
        }
    }
}