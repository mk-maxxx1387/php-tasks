<?php

class DBWork {
    protected $table;
    protected $fields;
    protected $vals;
    protected $query;

    public function connect(){
        $host = HOST;
        $dbname = DB_NAME;
        $user = USER;
        $pwd = PWD;
    }

    public function setTable($name){
        if($this->ifName($name)){
            $this->table = $name;
            return $this;
        } else {
            return FALSE;
        }
    }

    public function setFields($fields){
        if($this->ifArray($fields)){
            /*if(count($fields) != count($vals)){
                echo "Fields count must be equal values count";
                return FALSE;
            }*/

            foreach($fields as $fld){
                if(!$this->ifName($fld)){
                    return FALSE;
                }
            }

            $this->fields = $fields;
            return $this;
        }
        echo "Set fields failed. ";
        return FALSE;
    }

    public function setVals($vals){
        if($this->ifArray($vals)){
            $this->vals = $vals;
            return $this;
        }
        return FALSE;
    }

    public function selectEl(){
        if(!$this->ifTable() || !$this->ifFields()){
            echo "Select function failed. ";
            return FALSE;
        }

        $query = "SELECT ";
        $flds = $this->fields;
        $table = $this->table;
        $cnt = count($flds);

        for($i = 0; $i < $cnt; $i++){
            if($i != $cnt-1){
                $query .= "$flds[$i], ";
            } else {
                $query .= "$flds[$i] ";
            }
        }
        $query .= "FROM $table ";
        $this->query = $query;
        return $this;
    }

    public function whereEl($field, $oper){
        if($this->ifName($field) && $this->ifOper($oper) && $this->ifVals()){
                $this->query .= "WHERE $field $oper ?";
                return $this;
        }
        echo "Where failed.";
        return FALSE;
    }

    public function insertIntoEl(){
        if(!$this->ifTable() || !$this->ifFields()){
            echo "Insert function failed. ";
            return FALSE;
        }

        $query = "INSERT INTO $this->table(";
        $flds = $this->fields;
        $cnt = count($flds);

        for($i = 0; $i < $cnt; $i++){
            if($i != $cnt-1){
                $query .= $flds[$i].",";
            } else {
                $query .= $flds[$i].") ";
            }
        }

        $this->query = $query;
        return $this;
    }

    public function getValById($id){
        return $this->vals[$id];
    }

    public function valuesEl(){
        if(!$this->ifVals()){
            echo "Values function failed. ";
            return FALSE;
        }

        $vals = $this->vals;
        $flds = $this->fields;
        $this->query .= "VALUES(";

        /*for($i = 0; $i < count($vals); $i++){
            $this->query .= "'$vals[$i]'";
            if($i != count($vals)){
                $this->query .= ", "
            } else{
                $this->query .= ")";
            }
        }*/
        for($i = 0; $i < count($vals); $i++){
            $this->query .= "?";
            if($i != count($vals)-1){
                $this->query .= ", ";
            } else{
                $this->query .= ") ";
            }
        }


        return $this;
    }

    public function updateSetEl(){
        if(!$this->ifTable() || !$this->ifFields() || !$this->ifVals()){
            echo "Update function failed. ";
            return FALSE;
        }

        $query = "UPDATE $this->table SET ";
        $flds = $this->fields;
        $vals = $this->vals;
        $vCnt = count($flds);

        for($i = 0; $i < $fCnt; $i++){
            $query .= "$flds[$i] = ?";
            if($i != $fCnt-1){
                $query .= ', ';
            }
        }

        $this->query = $query;
        return $this;
    }

    public function deleteEl(){
        if(!$this->ifTable){
            echo "Delete function failed. ";
            return FALSE;
        }

        $this->query = "DELETE FROM $this->table ";
        return $this;
    }

    public function execute(){
        $query = $this->query;
        $query .= "LIMIT 1;";
        $this->query = $query;
    }

    public function ifFields(){
        if(!isset($this->fields)){
            echo "Fields aren`t set. ";
            return FALSE;
        }
        return TRUE;
    }

    public function ifVals(){
        if(!isset($this->vals)){
            echo "Values aren`t set. ";
            return FALSE;
        }
        return TRUE;
    }

    public function ifTable(){
        if(!isset($this->table)){
            echo "Table name isn`t set. ";
            return FALSE;
        }
        return TRUE;
    }

    public function ifArray($arr){
        if(!is_array($arr)){
            echo "It`s not array.";
            return FALSE;
        }
        return TRUE;
    }

    public function ifName($name){
        if(!preg_match("/^[A-Za-z_-]{2,12}$/", $name)){
            echo "It`s not right string. Only alphabetical between 2 and 12
letters";
            return FALSE;
        }
        return TRUE;
    }

    public function ifOper($op){
        $opers = array("=", "!=", ">", "<", "<=", ">=");
        if(!in_array($op, $opers)){
            echo "Wrong operator. Only =, !=, >, <, <=, >=";
            return FALSE;
        }
        return TRUE;
    }

    public function ifQuery(){
        if(!preg_match("/^(SELECT|DELETE)/", $this->query)){
            echo "Query must begin from SELELT or DELETE for this SQL function";
            return FALSE;
        }
    }
}
