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
        $this->config = $config['routes'];
    }

    /**
     * Method for matching request to proper class
     *
     * @param $path
     * @return string
     */
    public function match($path, $request)
    {

        $httpMethod = $request->getRequestMethod();
        $class      = "\\" . $this->config[$path][$httpMethod];

        return $class;
    }
}