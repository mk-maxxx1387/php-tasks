<?php

include_once("DB.php");
//include_once("Validator.php");

class RESTServer 
{
    protected static $repo;
    protected static $db;

    public static function start($repo){
        self::$repo = $repo;

        $url = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        $urlArr = explode("/", $url);
        $start = array_search('api', $urlArr);
        $class = $urlArr[$start+1];
        $param = $urlArr[$start+2];

        if(isset($class)){
            $func = strtolower($method).ucfirst($class);
            //make validation of parameters
            self::setMethod($func, $param);
            //prepare data to responce (select data type)
        }
    }

    protected static function setMethod($func, $param=false){
        if(method_exists(self::$repo, $func)){
            self::$repo->$func($param);
        }
    }
    
    public static function getDBConn(){
        if(!isset(self::$db)){
            self::$db = new DB();
        }
        return self::$db;
    }
}
