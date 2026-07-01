<?php

namespace AKAZA\Core;


class Config
{


private static array $data = [];



public static function load()
{

self::$data = require __DIR__.'/../../config/app.php';


}



public static function get($key)
{

return self::$data[$key] ?? null;


}


}