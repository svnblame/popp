<?php
declare(strict_types=1);

namespace POPP\Command;

class Registry
{
    public static function getMessageSystem(): MessageSystem
    {
        return new MessageSystem();
    }

    public static function getAccessManager(): AccessManager
    {
        return new AccessManager();
    }
}