<?php

namespace POPP\Observer\Observers;

use POPP\Observer\Authentication\Login;

class SecurityMonitor extends LoginObserver
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
