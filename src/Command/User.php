<?php
declare(strict_types=1);

namespace POPP\Command;

class User
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}