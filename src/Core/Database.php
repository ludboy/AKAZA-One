<?php

namespace AKAZA\Core;

use mysqli;
use Exception;


class Database
{

    private static ?mysqli $connection = null;


    public static function connect()
    {

        if(self::$connection){
            return self::$connection;
        }


        try {


            self::$connection = new mysqli(

                Config::get('db.host'),
                Config::get('db.user'),
                Config::get('db.password'),
                Config::get('db.database')

            );


            if(self::$connection->connect_error){

                throw new Exception(
                    self::$connection->connect_error
                );

            }


            self::$connection->set_charset("utf8mb4");


            Logger::info("Banco conectado");


            return self::$connection;


        } catch(Exception $e){


            Logger::info(
                "Erro banco: ".$e->getMessage()
            );


            throw $e;

        }

    }


}