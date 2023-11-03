<?php
declare(strict_types =1 );

namespace POPP\Registry;

require_once __DIR__ . '/../bootstrap.php';

try {
    Runner::run();
} catch (AppException $e) {
    print $e->getMessage() . PHP_EOL;
}
