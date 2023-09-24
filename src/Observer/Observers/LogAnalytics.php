<?php

namespace POPP\Observer\Observers;

use POPP\Observer\Contracts\IObservable;
use POPP\Observer\Contracts\IObserver;

class LogAnalytics implements IObserver
{
    public function update(IObservable $observable)
    {
        // not type safe!
        $status = $observable->getStatus();
        print __CLASS__ . ":   doing something with status info" . PHP_EOL;
        print_r($status);
    }
}
