<?php

namespace POPP\ObserverSpl;

use POPP\ObserverSpl\Authentication\Login;
use POPP\ObserverSpl\Observers\GeneralLogger;
use POPP\ObserverSpl\Observers\PartnershipTool;
use POPP\ObserverSpl\Observers\SecurityMonitor;

require_once __DIR__ . '/../bootstrap.php';

$login = new Login();
new SecurityMonitor($login);
new GeneralLogger($login);
new PartnershipTool($login);

$login->handleLogin('GeneKelley', 'secret', '127.0.0.1');

print PHP_EOL;

print_r($login->getStatus());

print PHP_EOL;
