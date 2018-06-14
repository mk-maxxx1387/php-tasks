<?php
include("config/config.php");

class MySql extends DBWork{
    private $pdo;

    public function __construct(){
        $dns = "mysql:host=".HOST.";dbname=".DB.";charset=utf8";
        $this->pdo = new PDO($dns, USER, PWD);
    }

    public function execute($vals){
        parent::queryEnd();
        $pdo = $this->pdo;
        $sth = $pdo->prepare($this->query);

        if($vals && $this->ifArray($vals)){
            foreach($vals as $key => $val){
                $sth->bindParam($key+1, $vals[$key]);
            }
        }

        if(!stristr($this->query, 'SELECT')){
            $result = $sth->execute();
            echo $this->query."<br>";
            if($result){
                echo "Query OK<br>";
                return TRUE;
            }
            echo "Query Failed<br>";
            return FALSE;
        }

        $sth->execute();
        echo $this->query."<br>";

        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        if($data){
            echo "Query OK<br>";
            return $data;
        }
        echo "Query Failed<br>";
        return FALSE;
    }
}
