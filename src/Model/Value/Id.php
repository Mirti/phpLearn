<?php
declare(strict_types=1);

namespace Learn\Model\Value;


class Id implements ValueInterface
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
     * @inheritdoc
     */
    public function toString(): string
    {
        return $this->id;
    }
}