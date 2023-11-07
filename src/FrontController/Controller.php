<?php
declare(strict_types=1);

namespace POPP\FrontController;

use Exception;

class Controller
{
    private Registry $registry;

    private function __construct()
    {
        $this->registry = Registry::instance();
    }

    /**
     * @return void
     * @throws AppException
     * @throws Exception
     */
    public static function run(): void
    {
        $instance = new Controller;
        $instance->init();
        $instance->handleRequest();
    }

    /**
     * @return void
     * @throws AppException
     */
    private function init(): void
    {
        $this->registry->getApplicationHelper()->init();
    }

    /**
     * @return void
     * @throws Exception
     */
    private function handleRequest(): void
    {
        $request = $this->registry->getRequest();
        $resolver = new CommandResolver;
        $command = $resolver->getCommand($request);
        $command->execute($request);
    }
}
