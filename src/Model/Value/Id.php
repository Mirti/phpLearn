<?php
declare(strict_types=1);

namespace Learn\Model\Value;


class Id
{

    /** @var string */
    protected $id;

    /**
     * Id constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}