<?php
declare(strict_types = 1);

namespace POPP\Visitor;

class Runner
{
    /**
     * @return void
     */
    public static function run(): void
    {
        $main_army = new Army();
        $main_army->addUnit(new Archer());
        $main_army->addUnit(new LaserCannonUnit());
        $main_army->addUnit(new Cavalry());

        $text_dump = new TextDumpArmyVisitor();
        $main_army->accept($text_dump);
        print $text_dump->getText();
    }

    public static function run2()
    {
        $main_army = new Army();
        $main_army->addUnit(new Archer());
        $main_army->addUnit(new LaserCannonUnit());
        $main_army->addUnit(new Cavalry());

        $tax_collector = new TaxCollectionVisitor();
        $main_army->accept($tax_collector);
        print $tax_collector->getReport();
        print "TOTAL: ";
        print $tax_collector->getTax() . PHP_EOL;
    }
}