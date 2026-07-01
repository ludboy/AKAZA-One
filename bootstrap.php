<?php

require __DIR__ . "/vendor/autoload.php";


use AKAZA\Core\Kernel;


$app = new Kernel();


$app->boot();


return $app;