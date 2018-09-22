<?php
declare(strict_types=1);

namespace Learn\Log\LogHandler;


use Assert\Assertion;
use const FILE_APPEND;
use Learn\Log\Formatter\FormatterInterface;
use Learn\Repository\Exception\LoggerException;
use function file_put_contents;

class FileHandler implements LogHandlerInterface
{
    /** @var FormatterInterface */
    private $formatter;
    /** @var string */
    private $file;

    /**
     * FileHandler constructor.
     *
     * @param FormatterInterface $formatter
     * @param array              $params
     *
     * @throws LoggerException
     */
    public function __construct(FormatterInterface $formatter, array $params)
    {
        Assertion::keyExists($params, 'file');
        Assertion::notNull($params['file']);
        Assertion::string($params['file']);

        $this->file      = $params['file'];
        $this->formatter = $formatter;
    }

    /**
     * @inheritdoc
     */
    function handle(array $log): void
    {
        $output = $this->formatter->format($log);

        file_put_contents($this->file, $output.PHP_EOL, FILE_APPEND);
    }
}