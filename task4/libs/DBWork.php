<?php

class DBWork {
    private $table;
    private $filelds;
    private $values;
    private $db;

    public function connect(){
        $host = HOST;
        $dbname = DB_NAME;
        $user = USER;
        $pwd = PWD;
    }

    public function setFields($fields){
        if(is_array){
            $this->fields = $fields;
        }
    }

    public function setValues($values){
        if(is_array
    }
    

    public function getTable(){
        return $this->table;
    }
    public function setTable($table){
        $this->table = $table;
    }
    
    public function checkArray(){
    }
}
