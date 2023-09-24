<?php

require_once __DIR__ . '/../bootstrap.php';

use POPP\Observer\Authentication\Login;
use POPP\Observer\Observers\GeneralLogger;
use POPP\Observer\Observers\PartnershipTool;
use POPP\Observer\Observers\SecurityMonitor;


$login = new Login();
new SecurityMonitor($login);
new GeneralLogger($login);
new PartnershipTool($login);

$login->handleLogin('GeneKelley', 'secret', '127.0.0.1');

print PHP_EOL;

print_r($login->getStatus());

print PHP_EOL;