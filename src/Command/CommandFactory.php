<?php
declare(strict_types=1);

namespace POPP\Command;

use Exception;

class CommandFactory
{
    private static string $srcDir = 'Commands';

    /**
     * @throws Exception
     */
    public static function getCommand(string $action = 'Default'): Command
    {
        if (preg_match('/\W/', $action)) {
            throw new Exception('Illegal characters in action');
        }

        $dir = self::$srcDir;

        $class = __NAMESPACE__ . "\\{$dir}\\" . UCFirst(strtolower($action)) . "Command";

        if (! class_exists($class)) {
            throw new CommandNotFoundException("'{$class}' not found");
        }

        return new $class();
    }
}