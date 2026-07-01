<?php

require "../vendor/autoload.php";


use AKAZA\Core\Kernel;
use AKAZA\Models\User;


$app = new Kernel();

$app->boot();



echo "<pre>";

print_r(
    User::all()
);

echo "</pre>";