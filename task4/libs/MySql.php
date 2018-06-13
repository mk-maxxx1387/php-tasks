<?php
include("config/config.php");

class MySql extends DBWork{
    private $pdo;
    public function __construct(){
        $dns = "mysql:host=".HOST.";dbname=".DB.";charset=utf8";
        $this->pdo = new PDO($dns, USER, PWD);
    }

    public function executeSel(){
        $query = $this->query.';';
        $pdo = $this->pdo;
        $sth = $pdo->prepare($query);
        $sth->execute($this->vals);
        var_dump($query);
        $data = $sth->fetchAll();
        if($data){
            return $data;
        }
        return FALSE;
    }

    public function execute(){
        parent::execute();
        $query = $this->query;
        $pdo = $this->pdo;
        $sth = $pdo->prepare($query);
        $sth->execute($this->vals);
    }
}
