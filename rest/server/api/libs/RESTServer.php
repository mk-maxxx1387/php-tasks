<?php

class RESTServer 
{
    protected static $repo;

    public static function start($repo){
        self::$repo = $repo;
        $url = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        list($a, $b, $c, $d, $e, $f, $class, $param) = explode("/", $url);
        if(isset($class)){
            self::setMethod($class, $param);
        }
        var_dump($class);
        var_dump($param);
    }

    protected static function setMethod($class, $param=null){
        
    }
    
    
}
