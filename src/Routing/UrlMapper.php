<?php
declare(strict_types=1);

namespace Learn\Routing;


class UrlMapper
{
    /** @var string */
    private $url;

    /**
     * UrlMapper constructor.
     *
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * @param array $routes
     *
     * @return string
     */
    public function toRoute(array $routes): string
    {
        foreach ($routes as $route => $methods) {
            if ($this->equal($route)) {
                return $route;
            }
        }

        throw new \InvalidArgumentException('Route not exists');
    }

    /**
     * @param string $route
     *
     * @return array
     */
    public function toRouteParams(string $route): array
    {
        $routeParts = explode('/', $route);
        $urlParts   = explode('/', $this->url);

        foreach ($routeParts as $i => $part) {
            if (strpos($part, ':') === 0) {
                $params[$part] = $urlParts[$i];
            }
        }

        return $params ?? [];
    }

    /**
     * @param string $route
     *
     * @return bool
     */
    public function equal(string $route): bool
    {
        $routeParts = explode('/', $route);
        $urlParts   = explode('/', $this->url);

        if (count($routeParts) !== count($urlParts)) {
            return false;
        }

        foreach ($routeParts as $i => $part) {
            $isEqual      = $part === $urlParts[$i];
            $isRouteParam = strpos($part, ':') === 0;

            if (!$isEqual && !$isRouteParam) {
                return false;
            }
        }

        return true;
    }
}