<?php

namespace AKAZA\Core;


abstract class Model
{


protected static string $table;



public static function all()
{

$db = Database::connect();


$result = $db->query(
"SELECT * FROM ".static::$table
);


$data=[];


while($row=$result->fetch_assoc()){

$data[]=$row;

}


return $data;


}



public static function find($id)
{

$db = Database::connect();


$stmt = $db->prepare(

"SELECT * FROM ".static::$table." WHERE id=?"

);


$stmt->bind_param("i",$id);


$stmt->execute();


return $stmt
->get_result()
->fetch_assoc();


}


} 