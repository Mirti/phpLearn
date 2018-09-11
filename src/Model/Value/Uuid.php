<?php
declare(strict_types=1);

namespace Learn\Model\Value;


class Uuid implements ValueObjectInterface
{
    /** @var */
    private $uuid;

    /**
     * Uuid constructor.
     * @param string $uuid
     */
    public function __construct(string $uuid = null)
    {
        if ($uuid == null) {
            $this->uuid = self::generate();
        } else {
            $this->uuid = $uuid;
        }
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
        return $this->uuid == $valueObject->__toString() ? true : false;
    }

    /**
     * @return \Rhumsaa\Uuid\Uuid
     */
    public static function generate()
    {
        return (\Rhumsaa\Uuid\Uuid::uuid4());
    }
}