<?php

declare(strict_types=1);


/*
|--------------------------------------------------------------------------
| AKAZA One - Front Controller
|--------------------------------------------------------------------------
|
| Todas as requisições HTTP entram por aqui.
| A responsabilidade deste arquivo é apenas
| carregar a aplicação.
|
*/


$app = require dirname(__DIR__) . '/bootstrap/app.php';


$app->run();