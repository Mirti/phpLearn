<?php
declare(strict_types=1);

namespace Learn\Model\Value;


class FirstName
{

    /** @var string */
    protected $firstName;

    /**
     * FirstName constructor.
     * @param string $firstName
     */
    public function __construct(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }
}