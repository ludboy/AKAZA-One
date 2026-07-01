<?php

namespace AKAZA\Core;


class Migration
{


public static function run($name,$sql)
{

$db = Database::connect();



$check = $db->prepare(
"SELECT id FROM migrations WHERE migration=?"
);


$check->bind_param(
"s",
$name
);


$check->execute();


$result = $check
->get_result();



if($result->num_rows > 0){

return false;

}



$db->query($sql);



$stmt=$db->prepare(
"INSERT INTO migrations (migration)
VALUES (?)"
);


$stmt->bind_param(
"s",
$name
);


$stmt->execute();



Logger::info(
"Migration executada: ".$name
);



return true;


}


}