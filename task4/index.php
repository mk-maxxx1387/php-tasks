<?php

include("config/config.php");
spl_autoload_register(function ($class_name){
    $file = "libs/$class_name.php";
    if(is_file($file)){
        include $file;
    }
});

$m = new MySql();
$fields = array('userid', 'userdata');
$vals = array('user3', date("Y-m-d H:i:s"));
$table = 'MY_TEST';

printSel($m, $fields, $vals);

$m->setTable($table)
    ->setFields(array('userdata'))
    ->setVals(array(date("Y-m-d H:i:s"), 'user3'))
    ->updateSetEl()
    ->whereEl('userid', '=')
    ->execute();





















function printSel($m,$f,$v = null, $t = 'MY_TEST'){
    $res = $m->setFields($f)
        ->setTable($t)
        ->selectEl()
        ->setVals($v)
        ->whereEl($f[0], '=')
        ->executeSel();
    $keys = array_keys($res[0]);
    $table .= "<table border='1'><tr>";
        foreach($keys as $val){
            $table .= "<th>$val</th>";
        }
    $table .= "</tr>";
    foreach($res as $vals){
        $table .= "<tr>";
        foreach($vals as $key => $val){
            $table .= "<td>$vals[$key]</td>";
        }
        $table .= "</tr>";
    }
    $table .= "</table>";
    echo $table;
}
