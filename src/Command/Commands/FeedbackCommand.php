<?php
declare(strict_types=1);

namespace POPP\Command\Commands;

use POPP\Command\Command;
use POPP\Command\CommandContext;
use POPP\Command\Registry;

class FeedbackCommand extends Command
{
    public function execute(CommandContext $context): bool
    {
        $msgSystem = Registry::getMessageSystem();
        $email = $context->get('email');
        $msg   = $context->get('msg');
        $topic = $context->get('topic');
        $result = $msgSystem->send($email, $msg, $topic);

        if (! $result) {
            $context->setError($msgSystem->getError());
            return false;
        }

        return true;
    }
}