<?php

namespace POPP\ObserverSpl\Observers;

use POPP\ObserverSpl\Authentication\Login;

class SecurityMonitor extends LoginObserver implements \SplObserver
{
    public function doUpdate(Login $login)
    {
        $status = $login->getStatus();

        if ($status[0] == Login::LOGIN_WRONG_PASS) {
            // send mail to sysadmin
            print __CLASS__ . ":   sending mail to sysadmin" . PHP_EOL;
        }
    }
}
