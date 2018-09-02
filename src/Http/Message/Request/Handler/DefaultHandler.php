<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request\Handler;


use Learn\Http\Message\Request\RequestInterface;
use Learn\Http\Message\Response\HttpResponse;
use Learn\Http\Message\Response\ResponseInterface;

class DefaultHandler implements RequestHandlerInterface
{
    /**
     * @inheritdoc
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        $info = "Zrobione: <br /><br/>
        /users <br />
        GET -> lista użyszkodników <br/>
        POST -> dodawanie użyszkodnika <br />
        {\"firstName\" : \"imie\", <br />
        \"lastName\" : \"nazwisko\"}";

        return new HttpResponse(200, [$info]);
    }
}