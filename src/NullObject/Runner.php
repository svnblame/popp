<?php
declare(strict_types=1);

namespace POPP\NullObject;

use POPP\Visitor\NullUnit;

class Runner
{
    /**
     * @return void
     */
    public static function run(): void
    {
        $acquirer = new UnitAcquisition();
        $tileForces = new TileForces(4, 2, $acquirer);

        $power = $tileForces->firePower();

        print "Power level is {$power}" . PHP_EOL;
    }

    public static function run2(): void
    {
        $unit = new NullUnit();

        if (! $unit->isNull()) {
            print "Unit is NOT Null - doing something useful now..." . PHP_EOL;
        } else {
            print "Unit is Null - No action required..." . PHP_EOL;
        }
    }
}
