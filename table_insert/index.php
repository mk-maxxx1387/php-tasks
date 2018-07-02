<?php
$pgsql = new PDO("pgsql:dbname=user3;user=user3;password=user3;host=localhost");
$i = 1;
/*$query = "CREATE TABLE IF NOT EXISTS user3 (
    id integer,
    name varchar(100),
    descr text
);";
$pgsql->query($query);
exit;*/
while($i < 1000000){
    $query = "INSERT INTO user3 (id, name, descr) VALUES ";
    for($j = 1; $j <= 500; $j++){
        $date = date_create();
        $name = md5(date_timestamp_get($date)."a".$i);
        $name = $name.$name.$name."aaaa";
        $desc = $name.$name.$name.$name.$name;

        if(500 == $j){
            $query .= "('$i','$name','$desc');";
        } else {
            $query .= "('$i','$name','$desc'),";
        }
        $i++;
    
    }
    echo $query."<br>";
    echo $pgsql->exec($query);
}

