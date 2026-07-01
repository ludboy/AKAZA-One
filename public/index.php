<?php

$app = require "../bootstrap.php";


use AKAZA\Core\Database;


try {


    Database::connect();


    echo "
    <h1>AKAZA One</h1>

    <p>Core iniciado com sucesso</p>

    <p>Versão:
    ".\AKAZA\Core\Config::get('version')."
    </p>
    ";


}
catch(Exception $e){

    echo "Erro: ".$e->getMessage();

}