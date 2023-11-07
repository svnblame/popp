<?php declare(strict_types=1);

namespace POPP\Command;

class CommandContext
{
    private $params = [];
    private $error = '';

    public function __construct()
    {
        $this->params = $_REQUEST;
    }

    public function addParam(string $key, $val)
    {
        $this->params[$key] = $val;
    }

    public function get(string $key): string
    {
        if (isset($this->params[$key])) {
            return $this->params[$key];
        }

        return '';
    }

    public function setError($error)
    {
        $this->error = $error;
    }

    public function getError(): string
    {
        return $this->error;
    }
}