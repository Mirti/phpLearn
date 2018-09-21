<?php
declare(strict_types=1);

namespace Learn\Log\Formatter;


class TextFormatter implements FormatterInterface
{
    /**
     * @param array $context
     * @return string
     */
    public static function format(array $context): string
    {
        return implode(" | ", $context) . "\n";
    }
}