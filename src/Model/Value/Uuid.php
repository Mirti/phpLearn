<?php
declare(strict_types=1);

namespace Learn\Model\Value;


class Uuid implements ValueObjectInterface
{
    /** @var */
    private $uuid;

    /**
     * Uuid constructor.
     */
    public function __construct()
    {
        $this->uuid = self::generate();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->uuid;
    }

    /**
     * @param ValueObjectInterface $valueObject
     * @return bool
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if ((string)$this->uuid == $valueObject->__toString()) {
            return true;
        }
        return false;
    }

    /**
     * @return string
     */
    public static function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}