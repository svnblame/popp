<?php declare(strict_types=1);

namespace POPP\FrontController;

abstract class Command
{
    final public function __construct() {}

    /**
     * @param Request $request
     * @return void
     */
    public function execute(Request $request): void
    {
        $this->doExecute($request);
    }

    /**
     * @param Request $request
     * @return void
     */
    abstract public function doExecute(Request $request): void;
}
