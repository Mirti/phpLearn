<?php
declare(strict_types=1);

namespace Learn\Log\Formatter;


use const PHP_EOL;

class TextFormatter implements FormatterInterface
{
    /**
     * @inheritdoc
     */
    public function format(array $context): string
    {
        return implode(" | ", $context) . PHP_EOL;
    }
}