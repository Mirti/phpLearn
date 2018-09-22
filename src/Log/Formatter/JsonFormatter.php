<?php
declare(strict_types=1);

namespace Learn\Log\Formatter;


class JsonFormatter implements FormatterInterface
{
    /**
     * @inheritdoc
     */
    public function format(array $context): string
    {
        return json_encode($context);
    }
}