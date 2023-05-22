<?php

abstract class Employee
{
    protected $name;
    private static $types= ['Minion', 'CluedUp', 'WellConnected'];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function recruit(string $name)
    {
        $num = rand(1, count(self::$types)) -1;
        $class = __NAMESPACE__ . "\\" . self::$types[$num];

        return new $class($name);
    }

    abstract public function fire();
}

class Minion extends Employee
{
    public function fire()
    {
        print "{$this->name}: I'll clear my desk" . PHP_EOL;
    }
}

class CluedUp extends Employee
{
    public function fire()
    {
        print "{$this->name}: I'll call my lawyer." . PHP_EOL;
    }
}

class WellConnected extends Employee
{
    public function fire()
    {
        print "{$this->name}: I'll call my dad." . PHP_EOL;
    }
}

class NastyBoss
{
    private $employees = [];

    public function addEmployee(Employee $employee)
    {
        $this->employees[] = $employee;
    }

    public function projectFails()
    {
        if (count($this->employees)) {
            $emp = array_pop($this->employees);
            $emp->fire();
        }
    }
}

$boss = new NastyBoss();
$boss->addEmployee(Employee::recruit('Harry'));
$boss->addEmployee(Employee::recruit('Bob'));
$boss->addEmployee(Employee::recruit('Mary'));
$boss->addEmployee(Employee::recruit('Gene'));

$boss->projectFails();
$boss->projectFails();
$boss->projectFails();
