<?php


require "../bootstrap.php";


use AKAZA\Models\User;


echo "<pre>";
echo "Users <br>";

print_r(
    User::all()
);

echo "</pre>";