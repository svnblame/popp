<?php

namespace POPP\Observer\Observers;

use POPP\Observer\Contracts\IObservable;
use POPP\Observer\Authentication\Login;
use POPP\Observer\Contracts\IObserver;

abstract class LoginObserver implements IObserver
{
    private Login $login;

    public function __construct(Login $login)
    {
        $this->login = $login;
        $login->attach($this);
    }

    public function update(IObservable $observable)
    {
        if ($observable === $this->login) {
            $this->doUpdate($observable);
        }
    }

    abstract public function doUpdate(Login $login);
}