<?php
declare(strict_types=1);

namespace Learn\Log\Formatter;


interface FormatterInterface
{
    /**
     * @param array $context
     *
     * @return string
     */
    function format(array $context): string;
}