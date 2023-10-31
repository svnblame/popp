<?php
declare(strict_types=1);

namespace POPP\Command;

class Controller
{
    /**
     * @var CommandContext
     */
    private CommandContext $context;

    public function __construct()
    {
        $this->context = new CommandContext;
    }

    public function getContext(): CommandContext
    {
        return $this->context;
    }

    /**
     * @throws \Exception
     */
    public function process(): void
    {
        $action = $this->context->get('action');
        $action = (is_null($action)) ? "default" : $action;
        $cmd = CommandFactory::getCommand($action);

        if (! $cmd->execute($this->context)) {
            // handle failure
        } else {
            // success
            // dispatch view
        }
    }
}