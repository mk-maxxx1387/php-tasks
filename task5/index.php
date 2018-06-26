<?php

spl_autoload_register(function ($class){
    include 'libs/' . $class . '.php';
});
session_start();

$key = 'name4';
$value = 'temp1234';

$mysql = new WorkMySql();
echo "<b>MySQL</b><br>";

$saveRes = $mysql->saveData($key, $value) ? 'Data has been saved' : 'Data wasn`t saved';
echo $saveRes;

$res = $mysql->getData($key);
$getRes = "<br> Name: " . $res['name'] . " , Value: " . $res['value'] . "<br>";
echo $getRes;

$deleteRes = $mysql->deleteData($key) ? 'Data has been deleted' : 'Data was not
deleted';
echo $deleteRes;

$sess = new WorkSession();
echo "<br><b>Session</b><br>";
$saveRes = $sess->saveData($key, $value.'2');
echo $saveRes.'<br>';
$getRes = $sess->getData($key);
echo $getRes.'<br>';
$delRes = $sess->deleteData($key) ? 'Data has been deleted' : 'Data was`nt deleted';
echo $delRes;

include('templates/main.php');


