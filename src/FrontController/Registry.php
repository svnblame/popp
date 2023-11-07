<?php declare(strict_types=1);

namespace POPP\FrontController;

#[\AllowDynamicProperties]
class Registry
{
    private array $values = [];
    private static Registry|null $instance = null;
    private Request|null $request = null;
    private Config|null $config = null;
    private Config|null $commands = null;
    private ApplicationHelper|null $applicationHelper = null;

    private function __construct() {}

    public static function instance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    /**
     * @return Request
     * @throws \Exception
     */
    public function getRequest(): Request
    {
        if (is_null($this->request)) {
            throw new \Exception('No request set');
        }

        return $this->request;
    }

    public function getApplicationHelper(): ApplicationHelper
    {
        if (is_null($this->applicationHelper)) {
            $this->applicationHelper = new ApplicationHelper;
        }

        return $this->applicationHelper;
    }

    /**
     * @param Config $conf
     * @return void
     */
    public function setConfig(Config $conf): void
    {
        $this->config = $conf;
    }

    /**
     * @return Config
     */
    public function getConf(): Config
    {
        if (is_null($this->config)) {
            $this->config = new Config();
        }

        return $this->config;
    }

    /**
     * @param Config $commands
     * @return void
     */
    public function setCommands(Config $commands): void
    {
        $this->commands = $commands;
    }

    public function getCommands(): Config
    {
        return $this->commands;
    }

    public function getDSN()
    {
        $config = $this->getConf();

        return $config->get('dsn');
    }
}
