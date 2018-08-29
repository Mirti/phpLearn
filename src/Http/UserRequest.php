<?php
declare(strict_types=1);

namespace Learn\Http;

use Learn\Http\Handler\User;

class UserRequest extends RequestImpl
{
    /**
     * UserRequest constructor.
     */
    function __construct()
    {
        parent::__construct();
    }
}