<?php declare(strict_types=1);

namespace POPP\FrontController;

abstract class Request
{
    protected array $properties = [];
    protected array $feedback = [];
    protected string $path = '/';

    public function __construct()
    {
        $this->init();
    }

    abstract public function init();

    /**
     * @param string $path
     * @return void
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getProperty(string $key): mixed
    {
        if (isset($this->properties[$key])) {
            return $this->properties[$key];
        }

        return null;
    }

    /**
     * @param string $key
     * @param $val
     * @return void
     */
    public function setProperty(string $key, $val): void
    {
        $this->properties[$key] = $val;
    }

    /**
     * @param string $msg
     * @return void
     */
    public function addFeedback(string $msg): void
    {
        $this->feedback[] = $msg;
    }

    public function getFeedback(): array
    {
        return $this->feedback;
    }

    /**
     * @param $separator
     * @return string
     */
    public function getFeedbackString($separator = PHP_EOL): string
    {
        return implode($separator, $this->feedback);
    }

    /**
     * @return void
     */
    public function clearFeedback(): void
    {
        $this->feedback = [];
    }
}