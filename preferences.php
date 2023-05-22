<?php

class Preferences
{
    private $props = [];
    private static $instance;

    private function __construct() {}

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function setProperty(string $key, string $val)
    {
        $this->props[$key] = $val;
    }

    public function getProperty(string $key): string 
    {
        return $this->props[$key];
    }
}

$pref = Preferences::getInstance();
$pref->setProperty('name', 'Gene');
unset($pref); // remove the reference
$pref2 = Preferences::getInstance();
print $pref2->getProperty('name') . PHP_EOL; // demonstrates that the value is not lost
