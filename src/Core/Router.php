<?php

namespace AKAZA\Core;


class Router
{


protected array $routes=[];



public function get($url,$callback)
{


$this->routes['GET'][$url]=$callback;


}



public function dispatch($uri)
{


$route=$this->routes['GET'][$uri] ?? null;


if(!$route){

http_response_code(404);

return "404";

}


return call_user_func($route);


}


}