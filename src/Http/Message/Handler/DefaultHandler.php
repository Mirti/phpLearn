<?php
declare(strict_types=1);

namespace Learn\Http\Message\Handler;

use Learn\Http\HttpResponse;
use Learn\Http\RequestInterface;

class DefaultHandler implements RequestHandlerInterface{

    /**
     * @param RequestInterface $request
     * @return mixed
     */
    public function handle(RequestInterface $request)
    {
        $info = "Zrobione: <br /><br/>
        /users <br />
        GET -> lista użyszkodników <br/>
        POST -> dodawanie użyszkodnika <br />
        {\"firstName\" : \"imie\", <br />
        \"lastName\" : \"nazwisko\"}";

        return new HttpResponse(200,$info);
    }
}