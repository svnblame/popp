<?php
declare(strict_types=1);

namespace POPP\Visitor;

class TroopCarrier extends CompositeUnit
{
    /**
     * @param Unit $unit
     * @return void
     * @throws UnitException
     */
    public function addUnit(Unit $unit): void
    {
        if ($unit instanceof Cavalry)
        {
            throw new UnitException("Can't get a horse on the vehicle");
        }
    }

    /**
     * @return int
     */
    public function bombardStrength(): int
    {
        return 0;
    }
}