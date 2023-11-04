<?php
declare(strict_types=1);

namespace POPP\Registry;

#[\AllowDynamicProperties]
class Registry
{
    private static $instance = null;
    private static bool $testMode = false;
    private $request = null;

    private $treeBuilder = null;
    private $conf = null;

    private function __construct() {}

    public static function instance(): self
    {
        if (is_null(self::$instance)) {
            if (self::$testMode) {
                self::$instance = new MockRegistry;
            } else {
                self::$instance = new self();
            }
        }

        return self::$instance;
    }

    public static function testMode(bool $mode = true)
    {
        self::$instance = null;
        self::$testMode = $mode;
    }

    public function get(string $key)
    {
        if (isset($this->values[$key])) {
            return $this->values[$key];
        }

        return null;
    }

    public function set(string $key, $value)
    {
        $this->values[$key] = $value;
    }

    public function getRequest(): Request
    {
        if (is_null($this->request)) {
            $this->request = new Request;
        }

        return $this->request;
    }

    public function treeBuilder(): TreeBuilder
    {
        if (is_null($this->treeBuilder)) {
            $this->treeBuilder = new TreeBuilder($this->conf()->get('treedir'));
        }

        return $this->treeBuilder;
    }

    public function conf(): Conf
    {
        if (is_null($this->conf)) {
            $this->conf = new Conf;
        }

        return $this->conf;
    }
}
