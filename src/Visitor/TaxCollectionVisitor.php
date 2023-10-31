<?php
declare(strict_types=1);

namespace POPP\Visitor;

class TaxCollectionVisitor extends ArmyVisitor
{
    /**
     * @var int
     */
    private int $due = 0;
    private string $report = '';

    /**
     * @param Unit $node
     * @return void
     */
    public function visit(Unit $node)
    {
        $this->levy($node, 1);
    }

    public function visitArcher(Archer $node)
    {
        $this->levy($node, 2);
    }

    public function visitCavalry(Cavalry $node)
    {
        $this->levy($node, 3);
    }

    public function visitTroopCarrier(TroopCarrier $node)
    {
        $this->levy($node, 5);
    }

    private function levy(Unit $unit, int $amount)
    {
        $this->report .= "Tax levied for " . get_class($unit);
        $this->report .= ": $amount" . PHP_EOL;
        $this->due += $amount;
    }

    public function getReport()
    {
        return $this->report;
    }

    public function getTax()
    {
        return $this->due;
    }
}