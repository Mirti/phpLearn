<?php
declare(strict_types=1);

namespace Learn\Log\LogType\Formatter;


class JsonFormatter implements FormatterInterface
{
    /**
     * @param array $context
     * @return string
     */
    public static function format(array $context): string
    {
        return json_encode($context);
    }
}