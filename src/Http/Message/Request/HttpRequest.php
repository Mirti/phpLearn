<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request;


class HttpRequest implements RequestInterface
{
    /** @var  */
    private $remoteAddress;
    /** @var string */
    private $method;
    /** @var string */
    private $url;
    /** @var string */
    private $route;
    /** @var array */
    private $routeParams;
    /** @var array */
    private $body;

    /**
     * HttpRequest constructor.
     * @param string $remoteAddress
     *
     * @param string $method
     *
     * @param string $url
     * @param string $route
     *
     * @param array  $routeParams
     * @param array  $body
     */
    public function __construct(
        string $remoteAddress,

        string $method,

        string $url,
        string $route,

        array $routeParams,
        array $body
    ) {
        $this->remoteAddress = $remoteAddress;
        $this->method = $method;

        $this->url   = $url;
        $this->route = $route;

        $this->routeParams = $routeParams;
        $this->body        = $body;
    }

    /**
     * @inheritdoc
     */
    public function getRemoteAddress(): string
    {
        return $this->remoteAddress;
    }

    /**
     * @inheritdoc
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @inheritdoc
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @inheritdoc
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @inheritdoc
     */
    public function getRouteParams(): array
    {
        return $this->routeParams;
    }

    /**
     * @inheritdoc
     */
    public function getBody(): array
    {
        return $this->body;
    }
}