<?php
declare(strict_types=1);

namespace POPP\NullObject;

class TileForces
{
    /**
     * @var int
     */
    private int $x;

    /**
     * @var int
     */
    private int $y;

    /**
     * @var array
     */
    private array $units = [];

    public function __construct(int $x, int $y, UnitAcquisition $acquisition)
    {
        $this->x = $x;
        $this->y = $x;
        $this->units = $acquisition->getUnits($this->x, $this->y);
    }

    public function firePower(): int
    {
        $power = 0;

        foreach ($this->units as $unit) {
            if (! is_null($unit)) {
                $power += $unit->bombardStrength();
            }
        }

        return $power;
    }

    public function health(): int
    {
        $health = 0;

        foreach ($this->units as $unit) {
            if (! is_null($unit)) {
                $health += $unit->getHealth();
            }
        }

        return $health;
    }
}