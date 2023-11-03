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
        $reg = Registry::instance();
        print_r($reg->getRequest());
    }
}