<?php
declare(strict_types=1);

namespace Learn\Model\Value;

interface ValueInterface{

    /**
     * @return string
     */
    public function toString(): string;
}