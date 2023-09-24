<?php

class ObjectAssembler
{
    private array $components = [];

    public function __construct(string $conf)
    {
        $this->configure($conf);
    }

    private function configure(string $conf): void
    {

        $data = require_once $conf;

        foreach ($data as $object) {
            $args = [];
            $name = $object['name'];

            foreach ($object['args'] as $arg) {
                $argclass = $arg;
                $args[] = $argclass;
            }

            $this->components[$name] = function () use ($name, $args) {
                $expandedArgs = [];
                foreach ($args as $arg) {
                    $expandedArgs[] = new $arg();
                }
                $rclass = new \ReflectionClass($name);
                return $rclass->newInstanceArgs($expandedArgs);
            };
        }
    }

    /**
     * @throws Exception
     */
    public function getComponent(string $class)
    {
        if (! isset($this->components[$class])) {
            throw new \Exception("Unknown component: `$class`");
        }

        return $this->components[$class]();
    }
}

class AppointmentMaker
{
    private AppointmentEncoder $encoder;

    public function __construct(AppointmentEncoder $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @return string
     */
    public function makeAppointment(): string
    {
        return $this->encoder->encode();
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

// Version 2: Dependency Injection approach
$assembler = new ObjectAssembler(__DIR__ . '/config/appointments.php');

try {
    $apptMaker = $assembler->getComponent('AppointmentMaker');
    $commsMgr  = $assembler->getComponent('BlogCommunicationsManager');
} catch (\Exception $e) {
    exit($e->getMessage() . PHP_EOL);
}

echo '<p>' . $commsMgr->getHeaderText() . '</p>';
echo '<p>' . $apptMaker->makeAppointment() . '</p>';
echo '<p>' . $commsMgr->getFooterText() . '</p>';

print PHP_EOL;

// Version 1: Service Locator and Prototype approach
/*$commsMgr = AppointmentConfig::getInstance()->getCommunicationsManager();
// $blogManager = new BlogCommunicationsManager();
print $commsMgr->getHeaderText();
print $commsMgr->getAppointmentEncoder()->encode();
print $commsMgr->getTtdEncoder()->encode();
print $commsMgr->getContactEncoder()->encode();
print $commsMgr->getFooterText();*/

/*$megaManager = new MegaCommunicationsManager();
print $megaManager->getHeaderText();
print $megaManager->getAppointmentEncoder()->encode();
print $megaManager->getTtdEncoder()->encode();
print $megaManager->getContactEncoder()->encode();
print $megaManager->getFooterText();*/
