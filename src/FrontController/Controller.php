<?php
declare(strict_types=1);

namespace POPP\FrontController;

class Controller
{
    private Registry $registry;

    private function __construct()
    {
        $this->registry = Registry::instance();
    }

    public static function run()
    {
        $instance = new Controller;
        $instance->init();
        $instance->handleRequest();
    }

    private function init()
    {
        $this->registry->getApplicationHelper()->init();
    }

    private function handleRequest()
    {
        $request = $this->registry->getRequest();
        $resolver = new CommandResolver;
        $command = $resolver->getCommand($request);
        $command->execute($request);
    }
}
