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

class RegistrationMgr
{
    public function register(Lesson $lesson)
    {
        // do something with this Lesson

        // now notify someone
        $notifier = Notifier::getNotifier();
        $notifier->inform("New lesson: cost ({$lesson->cost()})");
    }
}

abstract class Notifier
{
    public static function getNotifier(): Notifier
    {
        // aquire concrete class according to
        // configuration or other logic

        if (rand(1,2) === 1) {
            return new MailNotifier();
        } else {
            return new TextNotifier();
        }
    }

    abstract public function inform(string $message);
}

class MailNotifier extends Notifier
{
    public function inform($message)
    {
        print "MAIL notification: {$message}" . PHP_EOL;
    }
}

class TextNotifier extends Notifier
{
    public function inform($message)
    {
        print "TEXT notification: {$message}" . PHP_EOL;
    }
}

$lesson1 = new Seminar(4, new TimedCostStrategy());
$lesson2 = new Lecture(4, new FixedCostStrategy());

$mgr = new RegistrationMgr();
$mgr->register($lesson1);
$mgr->register($lesson2);
