<?php
declare(strict_types=1);

namespace POPP\Command;

class MessageSystem
{
    public function send(string $mail, string $msg, string $topic): bool
    {
        print "Sending $mail: $topic: $msg" . PHP_EOL;
        return true;
    }

    public function getError(): string
    {
        return 'Move along now, nothing to see here';
    }
}