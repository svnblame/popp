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
        $registry->set('request', new Request);

        $registry = Registry::instance();
        print_r($registry->get('request'));

        print PHP_EOL;
    }
}