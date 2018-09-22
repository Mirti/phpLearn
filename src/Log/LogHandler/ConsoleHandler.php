<?php
declare(strict_types=1);

namespace Learn\Log\LogHandler;


use Learn\Log\Formatter\FormatterInterface;

class ConsoleHandler implements LogHandlerInterface
{
    /** @var  FormatterInterface */
    private $formatter;

    /**
     * ConsoleHandler constructor.
     *
     * @param FormatterInterface $formatter
     */
    public function __construct(FormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * @inheritdoc
     */
    function handle(array $log): void
    {
        $output = $this->formatter->format($log);

        error_log($output);
    }
}