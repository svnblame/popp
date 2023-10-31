<?php
declare(strict_types=1);

namespace POPP\Visitor;

class Army extends CompositeUnit
{
    public function bombardStrength(): int
    {
        $strength = 0;
        foreach($this->units() as $unit) {
            $strength += $unit->bombardStrength();
        }
        return $strength;
    }
}