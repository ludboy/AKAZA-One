<?php


require "../vendor/autoload.php";


use AKAZA\Core\Kernel;
use AKAZA\Core\Migration;



$app = new Kernel();

$app->boot();



Migration::run(

"001_create_users",

"

CREATE TABLE users (

id INT AUTO_INCREMENT PRIMARY KEY,

name VARCHAR(150) NOT NULL,

email VARCHAR(150) UNIQUE NOT NULL,

password VARCHAR(255) NOT NULL,

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

)

"

);


echo "Migration concluída";