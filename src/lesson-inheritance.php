<?php

abstract class Lesson
{
    protected $duration;
    const FIXED = 1;
    const TIMED = 2;
    private $costtype;

    public function __construct(int $duration, int $costtype = 1)
    {
        $this->duration = $duration;
        $this->costtype = $costtype;
    }

    public function cost(): int
    {
        switch ($this->costtype) {
            case self::TIMED:
                return (5 * $this->duration);
                break;
            case self::FIXED:
                return 30;
                break;
            default:
                $this->costtype = self::FIXED;
                return 30;
        }
    }

    public function chargeType(): string
    {
        switch ($this->costtype) {
            case self::TIMED:
                return "hourly rate";
                break;
            case self::FIXED:
                return "fixed rate";
                break;
            default:
                $this->costtype = self::FIXED;
                return "fixed rate";
        }
    }
}

class Lecture extends Lesson
{
    public function __construct(int $duration, int $costtype)
    {
        parent::__construct($duration, $costtype);
    }
}

class Seminar extends Lesson
{
    public function __construct(int $duration, int $costtype)
    {
        parent::__construct($duration, $costtype);
    }
}

$lecture = new Lecture(5, Lesson::FIXED);
print "{$lecture->cost()} ({$lecture->chargeType()})" . PHP_EOL;

$seminar = new Seminar(3, Lesson::TIMED);
print "{$seminar->cost()} ({$seminar->chargeType()})" . PHP_EOL;

