<?php declare(strict_types=1);

namespace POPP\FrontController;

class ApplicationHelper
{
    private string $config = __DIR__ . "/data/woo_options.ini";
    private Registry $registry;

    public function __construct()
    {
        $this->registry = Registry::instance();
    }

    /**
     * @return void
     * @throws AppException
     */
    public function init(): void
    {
        $this->setupOptions();

        if (isset($_SERVER['REQUEST_METHOD'])) {
            $request = new HttpRequest;
        } else {
            $request = new CliRequest;
        }

        $this->registry->setRequest($request);
    }

    /**
     * @return void
     * @throws AppException
     */
    private function setupOptions(): void
    {
        if (! file_exists($this->config)) {
            throw new AppException('Could not find options file');
        }

        $options = parse_ini_file($this->config, true);

        $config = new Config($options['config']);
        $this->registry->setConfig($config);

        $commands = new Config($options['commands']);
        $this->registry->setCommands($commands);
    }
}
