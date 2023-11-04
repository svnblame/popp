<?php
declare(strict_types=1);

namespace POPP\Registry;

class Runner
{
    /**
     * @throws AppException
     */
    public static function run()
    {
        $registry = Registry::instance();
        $registry2 = Registry::instance();
        print_r($registry2->getRequest());
        print PHP_EOL;
        print_r($registry2->treeBuilder());
        print PHP_EOL;

        Registry::testMode();
        $mockRegistry = Registry::instance();
        print_r($mockRegistry);
        print PHP_EOL;

        Registry::testMode(false);

        $registry3 = Registry::instance();
        print_r($registry3);

        print PHP_EOL;
    }
}