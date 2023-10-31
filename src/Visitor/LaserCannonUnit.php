<?php
declare(strict_types=1);

namespace POPP\Visitor;

class LaserCannonUnit extends Unit
{

    /**
     * @return int
     */
    public function bombardStrength(): int
    {
        return 44;
    }
}