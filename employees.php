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

class NastyBoss
{
    private $employees = [];

    public function addEmployee(string $employeeName)
    {
        $this->employees[] = new Minion($employeeName);
    }

    public function projectFails()
    {
        if (count($this->employees) > 0) {
            $emp = array_pop($this->employees);
            $emp->fire();
        }
    }
}

$boss = new NastyBoss();
$boss->addEmployee("Harry");
$boss->addEmployee("Bob");
$boss->addEmployee("Mary");
$boss->addEmployee("Gene");

$boss->projectFails();
