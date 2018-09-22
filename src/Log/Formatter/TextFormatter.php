<?php
declare(strict_types=1);

namespace Learn\Log\Formatter;


class TextFormatter implements FormatterInterface
{
    /**
     * TextFormatter constructor.
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
        return implode(" | ", $context) . "\n";
    }
}