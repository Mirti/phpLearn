<?php
declare(strict_types=1);

namespace Learn\Log\Formatter;


interface FormatterInterface
{
    /**
     * FormatterInterface constructor.
     * @param array $params
     */
    function __construct(array $params);

    /**
     * @param array $context
     * @return mixed
     */
    function format(array $context);
}