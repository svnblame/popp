<?php

class AppointmentSettings
{
    public static $COMSTYPE = 'Blog';
}

class AppointmentConfig
{
    private static $instance;
    private $commsManager;

    private function __construct()
    {
        // will run only once
        $this->init();
    }

    private function init()
    {
        switch (AppointmentSettings::$COMSTYPE) {
            case 'Mega';
                $this->commsManager = new MegaCommunicationsManager();
                break;
            default:
                $this->commsManager = new BlogCommunicationsManager();
        }
    }

    public static function getInstance(): AppointmentConfig
    {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function getCommunicationsManager(): CommunicationsManager
    {
        return $this->commsManager;
    }
}

abstract class AppointmentEncoder
{
    abstract public function encode(): string;
}

abstract class ThingsToDoEncoder
{
    abstract public function encode(): string;
}

abstract class ContactEncoder
{
    abstract public function encode(): string;
}

abstract class CommunicationsManager
{
    abstract public function getAppointmentEncoder(): AppointmentEncoder;
    abstract public function getTtdEncoder(): ThingsToDoEncoder;
    abstract public function getContactEncoder(): ContactEncoder;
    abstract public function getHeaderText(): string;
    abstract public function getFooterText(): string;
}

class BlogAppointmentEncoder extends AppointmentEncoder
{
    public function encode(): string 
    {
        return 'Blog Calendar: Appointment data encoded' . PHP_EOL;
    }
}

class MegaAppointmentEncoder extends AppointmentEncoder
{
    public function encode(): string
    {
        return 'Mega Calendar: Appointment data encoded' . PHP_EOL;
    }
}

class BlogCommunicationsManager extends CommunicationsManager {
    public function getAppointmentEncoder(): AppointmentEncoder
    {
        return new BlogAppointmentEncoder();
    }

    public function getTtdEncoder(): ThingsToDoEncoder
    {
        return new BlogThingsToDoEncoder();
    }

    public function getContactEncoder(): ContactEncoder
    {
        return new BlogContactEncoder();
    }

    public function getHeaderText(): string 
    {
        return 'Blog Calendar: HEADER' . PHP_EOL;
    }

    public function getFooterText(): string 
    {
        return 'Blog Calendar: FOOTER' . PHP_EOL;
    }
}

class MegaCommunicationsManager extends CommunicationsManager
{
    public function getAppointmentEncoder(): AppointmentEncoder
    {
        return new MegaAppointmentEncoder();
    }

    public function getTtdEncoder(): ThingsToDoEncoder
    {
        return new MegaTtdEncoder();
    }

    public function getContactEncoder(): ContactEncoder
    {
        return new MegaContactEncoder();
    }

    public function getHeaderText(): string 
    {
        return 'Mega Calendar: HEADER' . PHP_EOL;
    }

    public function getFooterText(): string 
    {
        return 'Mega Calendar: FOOTER' . PHP_EOL;
    }
}

class BlogThingsToDoEncoder extends ThingsToDoEncoder
{
    public function encode():string
    {
        return 'Blog ThingsToDo: encoded' . PHP_EOL;
    }
}

class MegaTtdEncoder extends ThingsToDoEncoder
{
    public function encode():string
    {
        return 'Mega ThingsToDo: encoded' . PHP_EOL;
    }
}

class BlogContactEncoder extends ContactEncoder
{
    public function encode(): string
    {
        return 'Blog Contact: encoded' . PHP_EOL;
    }
}

class MegaContactEncoder extends ContactEncoder
{
    public function encode(): string
    {
        return 'Mega Contact: encoded' . PHP_EOL;
    }
}

$commsMgr = AppointmentConfig::getInstance()->getCommunicationsManager();
// $blogManager = new BlogCommunicationsManager();
print $commsMgr->getHeaderText();
print $commsMgr->getAppointmentEncoder()->encode();
print $commsMgr->getTtdEncoder()->encode();
print $commsMgr->getContactEncoder()->encode();
print $commsMgr->getFooterText();

print PHP_EOL;

/*$megaManager = new MegaCommunicationsManager();
print $megaManager->getHeaderText();
print $megaManager->getAppointmentEncoder()->encode();
print $megaManager->getTtdEncoder()->encode();
print $megaManager->getContactEncoder()->encode();
print $megaManager->getFooterText();*/
