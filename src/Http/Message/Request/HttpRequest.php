<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request;


class HttpRequest implements RequestInterface
{
    /** @var string */
    private $target;
    /** @var */
    private $method;

    /** @var */
    private $body;

    /**
     * HttpRequest constructor.
     *
     * @param string $target
     * @param string $method
     *
     * @param array  $body
     *
     */
    public function __construct(string $target, string $method, array $body)
    {
        $this->target = $target;
        $this->method = $method;

        $this->body = $body;
    }

    /**
     * @inheritdoc
     */
    public function getTarget(): string
    {
        return $this->target;
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
    public function getBody(): array
    {
        return $this->body;
    }
}