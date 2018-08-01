<?php

include 'config/config.php';
spl_autoload_register(function ($class_name) {
        include 'libs/'.$class_name.'.php';
        });

$action = $_POST['action'];
$result = "";

if($action){
    list($class, $method, $param) = explode('/', $action);
    if($class == "soap"){
        $class = new SoapCl();
    } elseif($class == "curl"){
        $class = new CurlCl();
    }

    if($param){
        echo $class->$method($param);
    } else {
        echo $class->$method();
    }
} else{
    include("templates/index.php");
}

