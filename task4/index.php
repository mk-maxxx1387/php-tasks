<?php

include("config/config.php");

spl_autoload_register(function ($class_name){
    $file = "libs/$class_name.php";
    if(is_file($file)){
        include $file;
    }
});

$mySql = new MySql();
$mySql->setTable('MY_TEST');
$fields = array('userid', 'userdata');
$vals = array('user3', 'first data');
$mySql->setFields($fields);
$mySql->setVals($vals);
$mySql->insertIntoEl()->valuesEl()->execute();
var_dump($mySql->selectEl()->executeSel());

