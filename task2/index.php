<?php

include_once("config.php");
include("libs/Calculator.php");

$calc = new Calculator();
$ops = array('add', 'substract', 'multiply', 'division', 'square', 'persent');
$res = array();

$calc->setA(2);
$calc->setB(0);

$res['a'] = $calc->getA();
$res['b'] = $calc->getB();

foreach($ops as $op){
    $res[$op] = $calc->callMethod($op);
}

include(MAIN_TPL);



