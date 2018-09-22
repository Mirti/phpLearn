<?php
declare(strict_types=1);

namespace Learn\Log\Formatter;


class JsonFormatter implements FormatterInterface
{
    /**
     * JsonFormatter constructor.
     * @param array $params
     */
    public function __construct(array $params)
    {

    }

    /**
     * @param array $context
     * @return string
     */
    public function format(array $context): string
    {
        return json_encode($context);
    }
}