<?php declare(strict_types=1);

namespace POPP\FrontController;

class DefaultCommand extends Command
{

    /**
     * @inheritDoc
     */
    public function doExecute(Request $request): void
    {
        $request->addFeedback('Welcome to WOO');
        include(__DIR__ . '/main.php');
    }
}