<?php
include('config/config.php');

class WorkMySql implements iWorkData{
    private $pdo;
    private $table = TABLE;

    public function __construct(){
        $dns = "mysql:host=".HOST.";dbname=".DB;
        $this->pdo = new PDO($dns, USER, PWD);
    }

    public function saveData($key, $value){
        if(!$this->getData($key)){
            return $this->addData($key, $value);
        }

        $sql = "UPDATE $this->table SET value=? WHERE name=?;";

        $sth = $this->pdo->prepare($sql);
        $sth->bindParam(1, $value);
        $sth->bindParam(2, $key);
        $res = $sth->execute();

        return $res;
    }
    
    public function addData($key, $value){
        $sql = "INSERT INTO $this->table (name, value) VALUES (?,?);";
        
        $sth = $this->pdo->prepare($sql);
        $sth->bindParam(1, $key);
        $sth->bindParam(2, $value);
        return $sth->execute();
    }

    public function getData($key){
        $sql = "SELECT name, value FROM $this->table WHERE name = ?;";

        $sth = $this->pdo->prepare($sql);
        $sth->bindParam(1, $key);
        $sth->execute();

        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if(!$result){
            return FALSE;
        }
        return $result;
    }


    public function deleteData($key){
        $sql = "DELETE FROM $this->table WHERE name = ?;";
        
        $sth = $this->pdo->prepare($sql);
        $sth->bindParam(1, $key);
        return $sth->execute();
    }
}
