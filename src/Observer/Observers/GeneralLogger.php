<?php

namespace POPP\Observer\Observers;

use POPP\Observer\Authentication\Login;

class GeneralLogger extends LoginObserver
{
    public function doUpdate(Login $login)
    {
        $status = $login->getStatus();

        // add login data to log
        print __CLASS__ . ":   add login data to log" . PHP_EOL;
    }
}