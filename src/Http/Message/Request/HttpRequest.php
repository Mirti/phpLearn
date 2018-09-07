<?php
declare(strict_types=1);

namespace Learn\Http\Message\Request;


class HttpRequest implements RequestInterface
{
    /** @var string */
    private $target;
    /** @var */
    private $method;

    /** @var  */
    private $id;

    /** @var */
    private $body;

    /**
     * HttpRequest constructor.
     * @param string $target
     * @param string $method
     * @param array  $body
     * @param string $id
     */
    public function __construct(string $target, string $method, array $body, string $id ="")
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
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getBody(): array
    {
        return $this->body;
    }
}