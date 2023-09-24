<?php

namespace POPP\ObserverSpl\Observers;

use POPP\ObserverSpl\Authentication\Login;

abstract class LoginObserver implements \SplObserver
{
    private $login;

    public function __construct(Login $login)
    {
        $this->login = $login;
        $login->attach($this);
    }

    #[\ReturnTypeWillChange]
    public function update(\SplSubject $subject): void
    {
        if ($subject === $this->login) {
            $this->doUpdate($subject);
        }
    }

    abstract public function doUpdate(Login $login);
}
