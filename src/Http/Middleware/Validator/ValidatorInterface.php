<?php
declare(strict_types=1);

namespace Learn\Http\Middleware\Validator;


use Learn\Http\Message\Request\RequestInterface;

interface ValidatorInterface
{
    /**
     * @param RequestInterface $request
     * @return mixed
     */
    function validate(RequestInterface $request);
}