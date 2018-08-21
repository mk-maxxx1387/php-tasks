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

    public function query($query, $data = false){
        if(!$data){
            $res = $this->pdo->query($query, PDO::FETCH_ASSOC);
            return $res->fetchAll();
        }
        $sth = $this->pdo->prepare($query);
    }
}
