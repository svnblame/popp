<?php

namespace POPP\ObserverSpl\Observers;

use POPP\ObserverSpl\Authentication\Login;

class GeneralLogger extends LoginObserver implements \SplObserver
{
    public function doUpdate(Login $login)
    {
        $status = $login->getStatus();

        // add login data to log
        print __CLASS__ . ":   add login data to log" . PHP_EOL;
    }
}
