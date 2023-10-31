<?php
declare(strict_types=1);

namespace POPP\Command;

class AccessManager
{
    public function login(string $user, string $pass): User
    {
        print "User $user has logged in" . PHP_EOL;
        return new User($user);
    }

    public function getError(): string
    {
        return 'Move along now, nothing to see here';
    }
}