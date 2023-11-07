<?php declare(strict_types=1);

namespace POPP\FrontController;

class Config
{
    private array $values = [];

    public function __construct(array $values = [])
    {
        $this->values = $values;
    }

    public function get(string $key)
    {
        if (isset($this->values[$key])) {
            return $this->values[$key];
        }

        return null;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set(string $key, mixed $value)
    {
        $this->values[$key] = $value;
    }
}