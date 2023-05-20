<?php

abstract class Lesson
{
    private $duration;
    private $costStrategy;

    public function __construct(int $duration, CostStrategy $strategy)
    {
        $this->duration = $duration;
        $this->costStrategy = $strategy;
    }

    public function cost(): int
    {
        return $this->costStrategy->cost($this);
    }

    public function chargeType(): string 
    {
        return $this->costStrategy->chargeType();
    }

    public function getDuration(): int 
    {
        return $this->duration;
    }
}

class Lecture extends Lesson
{
    public function __construct(int $duration, CostStrategy $strategy)
    {
        parent::__construct($duration, $strategy);

        // Lecture-specific implementations...
    }
}

class Seminar extends Lesson
{
        public function __construct(int $duration, CostStrategy $strategy)
    {
        parent::__construct($duration, $strategy);

        // Seminar-specific implementations...
    }
}

abstract class CostStrategy
{
    abstract public function cost(Lesson $lesson): int;
    abstract public function chargeType(): string;
}

class TimedCostStrategy extends CostStrategy
{
    public function cost(Lesson $lesson): int
    {
        return ($lesson->getDuration() * 5);
    }

    public function chargeType():  string 
    {
        return "hourly rate";
    }
}

class FixedCostStrategy extends CostStrategy
{
    public function cost(Lesson $lesson): int
    {
        return 30;
    }

    public function chargeType(): string 
    {
        return "fixed rate";
    }
}

$lessons[] = new Seminar(4, new TimedCostStrategy());
$lessons[] = new Lecture(4, new FixedCostStrategy());

foreach ($lessons as $lesson) {
    print "Lesson charge: {$lesson->cost()}. ";
    print "Charge type: {$lesson->chargeType()}" . PHP_EOL;
}