<?php
declare(strict_types=1);

namespace POPP\NullObject;

use POPP\Visitor\Army;
use POPP\Visitor\Archer;
use POPP\Visitor\Cavalry;
use POPP\Visitor\LaserCannonUnit;
use POPP\Visitor\NullUnit;

class UnitAcquisition
{
    public function getUnits(int $x, int $y): array
    {
        // 1. looks up x and y in local data and gets a list of unit ids
        // 2. goes off to a data source and gets full unit data

        // here's some fake data
        $army = new Army();
        $army->addUnit(new Archer());
        return [
            new Cavalry(),
            new NullUnit(),
            new LaserCannonUnit(),
            $army
        ];
    }
}
