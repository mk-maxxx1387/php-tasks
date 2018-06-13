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
        var_dump($query);
        $cntParam = substr_count($query, '?');
        $i = 0;
        if($cntParam){
            $vals = $this->vals;
            while($i < $cntParam){
                var_dump($vals[$i]);
                $sth->bindParam($i+1, $vals[$i]);
                $i++;

            }
        }
        $sth->execute();

        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        if($data){
            return $data;
        }
        return FALSE;
    }

    public function execute(){
        //parent::execute();

        $query = $this->query.';';
        $flds = $this->fields;
        $vals = $this->vals;
        $pdo = $this->pdo;
        $sth = $pdo->prepare($query);
        var_dump($query);
        exit;
        foreach($vals as $key => $val){
            $sth->bindParam($key+1, $vals[$key]);
        }

        //var_dump($query);
        //exit;
        $result = $sth->execute();
        var_dump($result);
        echo $this->query;
    }
}
