<?php
declare(strict_types=1);

namespace Learn\Http\Message\Response;


use function json_encode;

class HttpResponse implements ResponseInterface
{
    /** @var int */
    private $code;
    /** @var array */
    private $body;

    /**
     * HttpResponse constructor.
     *
     * @param int   $code
     * @param array $body
     */
    public function __construct(int $code, array $body = [])
    {
        $this->code = $code;
        $this->body = $body;
    }

    /**
     * @inheritdoc
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @inheritdoc
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * @inheritdoc
     */
    public function __toString(): string
    {
        return json_encode([
            'code' => $this->code,
            'body' => $this->body
        ]);
    }
}