<?php

require "../vendor/autoload.php";


use AKAZA\Core\Kernel;


try {

    $app = new Kernel();

    $app->boot();


    echo "
    <h1>AKAZA One</h1>
    <p>Core iniciado com sucesso</p>
    <p>Versão: ".\AKAZA\Core\Config::get('version')."</p>
    ";


} catch(Exception $e){

    echo "Erro: ".$e->getMessage();

}