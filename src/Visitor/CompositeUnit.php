<?php
declare(strict_types=1);

namespace POPP\Visitor;

abstract class CompositeUnit extends Unit
{
    /**
     * @var array
     */
    protected $units = [];

    public function getComposite(): Unit
    {
        return $this;
    }

    public function units(): array
    {
        return $this->units;
    }

    public function removeUnit(Unit $unit)
    {
        $units = [];

        foreach ($this->units as $thisUnit) {
            if ($unit !== $thisUnit) {
                $units[] = $thisUnit;
            }
        }

        $this->units = $units;
    }

    public function getHealth(): int
    {
        $health = 0;

        foreach ($this->units() as $unit) {
            $health += $unit->getHealth();
        }

        return $health;
    }

    public function addUnit(Unit $unit)
    {
        foreach ($this->units as $thisUnit) {
            if ($unit === $thisUnit) {
                return;
            }
        }

        $unit->setDepth($this->depth + 1);
        $this->units[] = $unit;
    }

    /**
     * @param ArmyVisitor $visitor
     * @return void
     */
    public function accept(ArmyVisitor $visitor): void
    {
        parent::accept($visitor);

        foreach ($this->units as $thisUnit) {
            $thisUnit->accept($visitor);
        }
    }
}