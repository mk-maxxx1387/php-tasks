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
        $class->$method();
    }
} else{
    include("templates/index.php");
}


//$result = invertStrCURL();
//$result = getCurrenciesCURL();
//foreach($result as $obj){
//var_dump($obj->sISOCode);
//}


/* SOAP
   $currencies = getCurrenciesSoap();

   foreach($currencies as $curr){
   foreach($curr as $param){
   print_r("ISO Code: ".$param->sISOCode."<br>");
   print_r("Name: ".$param->sName."<br>");
   }
   }
 */
