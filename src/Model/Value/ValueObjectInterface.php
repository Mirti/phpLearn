<?php
declare(strict_types=1);

namespace Learn\Model\Value;

interface ValueObjectInterface{

    /**
     * @return string
     */
    public function __toString();

    /**
     * @param ValueObjectInterface $valueObject
     * @return bool
     */
    public function equals(ValueObjectInterface $valueObject): bool;
}