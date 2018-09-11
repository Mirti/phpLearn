<?php
declare(strict_types=1);

namespace Learn\Model\Value;


class Id extends Uuid implements ValueObjectInterface
{

    /** @var string */
    protected $userId;

    /**
     * Id constructor.
     */
    public function __construct()
    {
        $this->userId = self::generate();
    }
}