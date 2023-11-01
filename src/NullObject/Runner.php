<?php
declare(strict_types=1);

namespace POPP\NullObject;

class Runner
{
    public static function run()
    {
        $acquirer = new UnitAcquisition();
        $tileForces = new TileForces(4, 2, $acquirer);
        $power = $tileForces->firePower();

        print "Power level is {$power}" . PHP_EOL;
    }
}
