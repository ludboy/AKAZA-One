<?php

namespace AKAZA\Core;


class Logger
{


public static function info($message)
{

$file = __DIR__."/../../storage/logs/app.log";


$data =
date("Y-m-d H:i:s")
." INFO "
.$message
."\n";


file_put_contents(
$file,
$data,
FILE_APPEND
);


}


}