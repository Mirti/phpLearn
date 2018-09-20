<?php
declare(strict_types=1);

namespace Learn\Log\LogType\Formatter;


interface FormatterInterface
{
    /**
     * @param array $context
     * @return mixed
     */
    static function format(array $context);
}