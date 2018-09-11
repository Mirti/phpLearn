<?php
declare(strict_types=1);

namespace Learn\Model\Value;


class UserId extends Uuid implements ValueObjectInterface
{

    /** @var string */
    protected $userId;

    /**
     * Id constructor.
     * @param string|null $userId
     */
    public function __construct(string $userId = null)
    {
        parent::__construct($userId);
    }
}