<?php declare(strict_types=1);

namespace POPP\FrontController;

class CommandResolver
{
    private static $refCommand = null;
    private static $defaultCommand = DefaultCommand::class;

    public function __construct()
    {
        self::$refCommand = new \ReflectionClass(Command::class);
    }

    public function getCommand(Request $request): Command
    {
        $registry = Registry::instance();
        $commands = $registry->getCommands();
        $path = $request->getPath();
        $class = $commands->get($path);

        if (is_null($class)) {
            $request->addFeedback("Path '{$path}' not matched");
            return new self::$defaultCommand();
        }

        if (! class_exists($class)) {
            $request->addFeedback("Class '{$class}' not found");
            return new self::$defaultCommand();
        }

        $refClass = new \ReflectionClass($class);;

        if (! $refClass->isSubclassOf(self::$refCommand)) {
            $request->addFeedback("Command '{$refClass}' is not a Command");
            return new self::$defaultCommand();
        }

        return $refClass->newInstance();
    }
}
