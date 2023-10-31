<?php
declare(strict_types=1);

namespace POPP\Command;

use Exception;

class Runner
{
    /**
     * @throws Exception
     */
    public static function run(): void
    {
        $controller = new Controller();
        $context = $controller->getContext();

        $context->addParam('action', 'login');
        $context->addParam('username', 'bob');
        $context->addParam('pass', 'tiddles');
        $controller->process();

        print $context->getError() . PHP_EOL;
    }

    public static function run2(): void
    {
        $controller = new Controller();
        $context = $controller->getContext();

        $context->addParam('action', 'feedback');
        $context->addParam('email', 'bob@example.com');
        $context->addParam('topic', 'My Brain');
        $context->addParam('msg', 'All about my brain');
        $controller->process();

        print $context->getError() . PHP_EOL;
    }
}