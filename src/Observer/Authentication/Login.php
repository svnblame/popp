<?php

namespace POPP\Observer\Authentication;

use POPP\Observer\Contracts\IObservable;
use POPP\Observer\Contracts\IObserver;

class Login implements IObservable
{
    private array $observers = [];

    private array $status = [];

    protected bool $isValid = false;

    const LOGIN_USER_UNKNOWN = 1;
    const LOGIN_WRONG_PASS = 2;
    const LOGIN_ACCESS = 3;

    public function attach(IObserver $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(IObserver $observer)
    {
        $this->observers = array_filter(
            $this->observers,
            function ($a) use ($observer) {
                return (! ($a === $observer));
            }
        );
    }

    public function notify()
    {
        foreach ($this->observers as $obs) {
            $obs->update($this);
        }
    }

    public function handleLogin(string $user, string $pass, string $ip)
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
