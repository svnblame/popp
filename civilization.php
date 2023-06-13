<?php
declare(strict_types=1);

abstract class Unit
{
    public function getComposite()
    {
        return null;
    }

    abstract public function bombardStrength(): int;
}

class UnitException extends \Exception {}

abstract class CompositeUnit extends Unit
{
    private array $units = [];

    /**
     * @return CompositeUnit
     */
    public function getComposite(): CompositeUnit
    {
        return $this;
    }

    public function addUnit(Unit $unit): void
    {
        if (in_array($unit, $this->units, true)) {
            return;
        }

        $this->units[] = $unit;
    }

    public function removeUnit(Unit $unit): void
    {
        $idx = array_search($unit, $this->units, true);

        if (is_int($idx)) {
            array_splice($this->units, $idx, 1, []);
        }
    }

    public function getUnits(): array
    {
        return $this->units;
    }
}

class Archer extends Unit
{
    public function bombardStrength(): int
    {
        return 4;
    }
}

class LaserCannonUnit extends Unit
{
    public function bombardStrength(): int
    {
        return 44;
    }
}

class Cavalry extends Unit
{
    public function bombardStrength(): int
    {
        return 3;
    }
}

class Soldier extends Unit
{
    public function bombardStrength(): int
    {
        return 8;
    }
}

class Tank extends Unit
{
    public function bombardStrength(): int
    {
        return 4;
    }
}

class Army extends CompositeUnit
{

    public function bombardStrength(): int
    {
        $ret = 0;

        foreach ($this->getUnits() as $unit) {
            $ret += $unit->bombardStrength();
        }

        return $ret;
    }
}

class TroopCarrier extends CompositeUnit
{
    public function addUnit(Unit $unit): void
    {
        if ($unit instanceof Cavalry) {
            throw new UnitException("Can't get a horse on the vehicle");
        }

        parent::addUnit($unit);
    }

    public function bombardStrength(): int
    {
        return 0;
    }
}

class UnitScript
{
    public static function joinExisting(Unit $newUnit, Unit $occupyingUnit): CompositeUnit
    {
        $comp = $occupyingUnit->getComposite();

        if (! is_null($comp)) {
            $comp->addUnit($newUnit);
        } else {
            $comp = new Army();
            $comp->addUnit($occupyingUnit);
            $comp->addUnit($newUnit);
        }

        return $comp;
    }
}

class Runner
{
    public static function run(): void
    {
        $army1 = new Army;
        $army1->addUnit(new Archer);
        $army1->addUnit(new Archer);

        $army2 = new Army;
        $army2->addUnit(new Archer);
        $army2->addUnit(new Archer);
        $army2->addUnit(new LaserCannonUnit);
        $army2->addUnit(new Soldier);

        $composite = UnitScript::joinExisting($army2, $army1);
        print_r($composite);
        print "Combined Bombard Strength: " . $composite->bombardStrength();

        print PHP_EOL . PHP_EOL;

        // Demonstrate UnitException
        $troopCarrier = new TroopCarrier();

        try {
            $troopCarrier->addUnit(new Cavalry);
        } catch (UnitException $e) {
            exit($e->getMessage() . PHP_EOL);
        }
    }
}

Runner::run();
