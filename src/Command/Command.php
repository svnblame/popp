<?php declare(strict_types=1);

namespace POPP\Command;

abstract class Command
{
    abstract public function execute(CommandContext $context): bool;
}