<?php

namespace POPP\Observer\Observers;

use POPP\Observer\Authentication\Login;

class PartnershipTool extends LoginObserver
{
    public function doUpdate(Login $login)
    {
        $status = $login->getStatus();

        // check IP address
        // set cookie if it matches a list
        print __CLASS__ . ":   set cookie if it matches a list" . PHP_EOL;
    }
}
