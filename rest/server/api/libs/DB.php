<?php

class DB {
    private $pdo;

    public function __construct(){
        $dns = "mysql:dbname=user3;host=localhost";
        $user = "user3";
        $pwd = "user3";
        $this->pdo = new PDO($dns, $user, $pwd);
        return $this->pdo;
    }

    public function query($query, $data = false, $query_type = 'one'){
        if(!$data){
            $res = $this->pdo->query($query, PDO::FETCH_ASSOC);
            return $res->fetchAll();
        }
        //var_dump($data);
        $sth = $this->pdo->prepare($query);
        $sth->execute($data);
        if($query_type == 'one'){
            return $sth->fetch(PDO::FETCH_ASSOC);
        } else if($query_type == 'many'){
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        
        
    }
}
