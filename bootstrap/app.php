<?php

declare(strict_types=1);

use Akaza\Foundation\Application;

use App\Providers\AppServiceProvider;
use App\Providers\DatabaseServiceProvider;
use App\Providers\LoggerServiceProvider;


/*
|--------------------------------------------------------------------------
| Load Composer
|--------------------------------------------------------------------------
*/

require dirname(__DIR__) . '/vendor/autoload.php';



/*
|--------------------------------------------------------------------------
| Create Application
|--------------------------------------------------------------------------
*/

$app = new Application(
    dirname(__DIR__)
);



/*
|--------------------------------------------------------------------------
| Register Application Providers
|--------------------------------------------------------------------------
|
| Aqui entram todos os serviços
| que a aplicação precisa.
|
*/


$app->register(
    new AppServiceProvider($app)
);


$app->register(
    new DatabaseServiceProvider($app)
);


$app->register(
    new LoggerServiceProvider($app)
);



/*
|--------------------------------------------------------------------------
| Boot Providers
|--------------------------------------------------------------------------
*/

$app->boot();



return $app;