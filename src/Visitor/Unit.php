<?php
declare(strict_types=1);
namespace POPP\Visitor;

abstract class Unit
{
    protected $units = [];
    protected $health = 10;
    protected $depth = 0;

    public function getComposite()
    {
        return null;
    }

    abstract public function bombardStrength();

    public function getHealth(): int
    {
        return $this->getHealth();
    }

    public function isNull(): bool
    {
        return false;
    }

    /**
     * @param ArmyVisitor $visitor
     * @return void
     */
    public function accept(ArmyVisitor $visitor): void
    {
        $ref = new \ReflectionClass(get_class($this));
        $method = "visit" . $ref->getShortName();
        $visitor->$method($this);
    }

    protected function setDepth($depth)
    {
        $this->depth = $depth;
    }

    public function getDepth(): int
    {
        return $this->depth;
    }
}