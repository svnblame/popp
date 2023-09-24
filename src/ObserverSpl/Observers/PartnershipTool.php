<?php

namespace POPP\ObserverSpl\Observers;

use POPP\ObserverSpl\Authentication\Login;

class PartnershipTool extends LoginObserver implements \SplObserver
{
    public function doUpdate(Login $login)
    {
        $status = $login->getStatus();

        // check IP address
        // set cookie if it matches a list
        print __CLASS__ . ":   set cookie if it matches a list" . PHP_EOL;
    }
}
