<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Akaza\Foundation\Application;


$app = new Application(
    dirname(__DIR__)
);


return $app;