<?php

namespace POPP\ObserverSpl\Observers;

class LogAnalytics implements \SplObserver
{
    public function update(\SplSubject $subject)
    {
        // not type safe!
        $status = $subject->getStatus();
        print __CLASS__ . ":   doing something with status info" . PHP_EOL;
        print_r($status);
        print PHP_EOL;
    }
}