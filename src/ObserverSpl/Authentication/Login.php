<?php

namespace POPP\ObserverSpl\Authentication;

class Login implements \SplSubject
{
    private array $observers = [];

    private \SplObjectStorage $storage;

    private array $status;

    protected bool $isValid = false;

    const LOGIN_USER_UNKNOWN = 1;
    const LOGIN_WRONG_PASS = 2;
    const LOGIN_ACCESS = 3;

    public function __construct()
    {
        $this->storage = new \SplObjectStorage;
    }

    /**
     * @param \SplObserver $observer
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function attach(\SplObserver $observer): void
    {
        $this->storage->attach($observer);
    }

    /**
     * @param \SplObserver $observer
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function detach(\SplObserver $observer): void
    {
        $this->storage->detach($observer);
    }

    /**
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function notify(): void
    {
        foreach ($this->storage as $obs) {
            $obs->update($this);
        }
    }

    /**
     * Handle Login attempts.
     *
     * @param string $user
     * @param string $pass
     * @param string $ip
     * @return bool
     */
    public function handleLogin(string $user, string $pass, string $ip): bool
    {
        switch (rand(1, 3)) {
            case 1:
                $this->setStatus(self::LOGIN_ACCESS, $user, $ip);
                $this->isValid = true;
                break;
            case 2:
                $this->setStatus(self::LOGIN_WRONG_PASS, $user, $ip);
                $this->isValid = false;
                break;
            case 3:
                $this->setStatus(self::LOGIN_USER_UNKNOWN, $user, $ip);
                $this->isValid = false;
                break;
        }

        $this->notify();

        return $this->isValid;
    }

    private function setStatus(int $status, string $user, string $ip)
    {
        $this->status = [$status, $user, $ip];
    }

    public function getStatus(): array
    {
        return $this->status;
    }
}