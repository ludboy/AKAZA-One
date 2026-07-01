<?php

namespace AKAZA\Core;


class Config
{


    private static array $data = [];


    public static function load()
{

    self::$data = require __DIR__ . "/../../config/app.php";

}



    public static function get(string $key)
    {

        $keys = explode('.', $key);


        $value = self::$data;


        foreach($keys as $item){

            if(!isset($value[$item])){

                return null;

            }


            $value = $value[$item];

        }


        return $value;

    }


}