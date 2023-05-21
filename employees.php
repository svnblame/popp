<?php

abstract class Employee
{
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
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
$boss->addEmployee(new Minion('Harry'));
$boss->addEmployee(new CluedUp('Bob'));
$boss->addEmployee(new Minion('Mary'));
$boss->addEmployee(new CluedUp('Gene'));

$boss->projectFails();
$boss->projectFails();
$boss->projectFails();
