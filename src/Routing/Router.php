<?php
declare (strict_types=1);

namespace Learn\Routing;


use Learn\Http\RequestInterface;

class Router
{
    /** @var array */
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Method for matching request to proper class
     *
     * @param RequestInterface $request
     * @return string
     */
    public function match($request)
    {

        $httpMethod = $request->getMethod();
        $target     = $request->getTarget();

        $class      = "\\" . $this->config[$target][$httpMethod];

        return $class;
    }
}