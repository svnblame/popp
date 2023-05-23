<?php

abstract class ApptEncoder
{
    abstract public function encode(): string;
}

class BloggsApptEncoder extends ApptEncoder
{
    public function encode(): string 
    {
        return 'Appointment data encoded in BloggsCal format' . PHP_EOL;
    }
}

class MegaApptEncoder extends ApptEncoder
{
    public function encode(): string
    {
        return 'Appointment data encoded in MegaCal format' . PHP_EOL;
    }
}

class CommsManager {
    const BLOGGS = 1;
    const MEGA   = 2;
    private $mode;

    public function __construct(int $mode)
    {
        $this->mode = $mode;
    } 

    public function getApptEncoder(): ApptEncoder
    {
        switch ($this->mode) {
            case (self::MEGA):
                return new MegaApptEncoder();
                break;
            default:
                return new BloggsApptEncoder();
                break;
        }
    }
}

$man = new CommsManager(CommsManager::MEGA);
print (get_class($man->getApptEncoder())) . PHP_EOL;

$man = new CommsManager(CommsManager::BLOGGS);
print (get_class($man->getApptEncoder())) . PHP_EOL;
