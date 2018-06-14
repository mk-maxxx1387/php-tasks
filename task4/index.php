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
$vals = array('user3', 'first data5');
$selV = array('user3');
$table = 'MY_TEST';

//printSel($m, $fields, $selV);
//$m->insertInto($table, $fields)->execute($vals);
printSel($m, $fields, $selV);
/*$m->update($table)
    ->set(array('userdata'))
    ->where('userid', '=')
    ->execute(array(date("Y-m-d H:i:s"), 'user3'));

printSel($m, $fields, $selV);
*/
$m->del()
    ->from($table)
    ->where('userdata', '=')
    ->limit(0)
    ->execute(array('first data1'));

//printSel($m, $fields, $selV);


function printSel($m,$f,$v, $t = 'MY_TEST'){
    $res = $m->select()
        //->distinct()
        ->addFields($f)
        ->from($t)
        ->groupBy()
        ->agr('COUNT', 'userid', false)
        //->orderBy(array('userdata'), 'ASC')
        ->execute($v);
    if(!$res){
        return FALSE;
    }
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
