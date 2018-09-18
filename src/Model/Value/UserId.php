<?php
declare(strict_types=1);

namespace Learn\Model\Value;


use Rhumsaa\Uuid\Uuid;

class UserId implements ValueObjectInterface
{
    /** @var */
    private $uuid;

    /**
     * UserId constructor.
     * @param Uuid $uuid
     */
    public function __construct(Uuid $uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return UserId
     */
    public static function generate(): UserId
    {
        return new self(Uuid::uuid4());
    }

    /**
     * @param string $userId
     * @return UserId
     */
    public static function fromString(string $userId): UserId
    {
        return new self(Uuid::fromString($userId));
    }

    /**
     * @inheritdoc
     */
    public function __toString(): string
    {
        return $this->uuid->toString();
    }

    /**
     * @inheritdoc
     */
    public function equals(ValueObjectInterface $other): bool
    {
        return $this->uuid === $other->__toString();
    }
}