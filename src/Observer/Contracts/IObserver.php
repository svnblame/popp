<?php

namespace POPP\Observer\Contracts;

interface IObserver
{
    public function update(IObservable $observable);
}