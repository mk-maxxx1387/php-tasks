<?php

class DBWork {
    protected $table;
    protected $fields;
    protected $vals;
    protected $query;

    public function setTable($name){
        if($this->ifName($name)){
            $this->table = $name;
            return $this;
        } else {
            return FALSE;
        }
    }

    public function setFields($fields){
        if(!$this->ifArray($fields)){
            echo "Set fields failed. ";
            return FALSE;
        }
        foreach($fields as $fld){
            if(!$this->ifName($fld)){
                return FALSE;
            }
        }

        $this->fields = $fields;
        return $this;
    }

    public function setVals($vals){
        if($this->ifArray($vals)){
            $this->vals = $vals;
            return $this;
        }
        echo "Values aren`t set";
        return FALSE;
    }

    public function select(){
        if(!$this->ifTable() || !$this->ifFields()){
            echo "Select function failed. ";
            return FALSE;
        }

        $query = "SELECT ";
        $query .= implode(",", $this->fields);
        $query .= " FROM $this->table ";

        $this->query = $query;
        return $this;
    }
    
    public function distinct(){
        $this->query .= 'DISTINCT';
        return $this;
    }

    public function where($field, $oper){
        if(!$this->ifName($field) 
        || !$this->ifOper($oper) 
        || !$this->ifVals()){
            echo "Where failed.";
            return FALSE;
        }
         $this->query .= "WHERE $field $oper ?";
         return $this;
    }

    public function insertInto(){
        if(!$this->ifTable() || !$this->ifFields()){
            echo "Insert function failed. ";
            return FALSE;
        }

        $query = "INSERT INTO $this->table(";
        $query .= implode(",", $this->fields).") ";

        $this->query = $query;
        return $this;
    }

    public function values(){
        if(!$this->ifVals()){
            echo "Values function failed. ";
            return FALSE;
        }

        $vals = $this->vals;
        $this->query .= "VALUES(";

        foreach($vals as $key => $val){
            $vals[$key] = "?";
        }
        $this->query .= implode(",", $vals).") ";

        return $this;
    }

    public function updateSet(){
        if(!$this->ifTable() || !$this->ifFields() || !$this->ifVals()){
            echo "Update function failed. ";
            return FALSE;
        }

        $query = "UPDATE $this->table SET ";
        $flds = $this->fields;

        foreach($flds as $key => $val){
            $flds[$key] = $val." = ? ";
        }
        $query .= implode(",",$flds);

        $this->query = $query;
        return $this;
    }

    public function deleteFrom(){
        if(!$this->ifTable()){
            echo "Delete function failed. ";
            return FALSE;
        }

        $this->query = "DELETE FROM $this->table ";
        return $this;
    }

    public function execute(){
        $this->ifLimit();
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

    public function ifLimit(){
        if(preg_match("/^(UPDATE|DELETE)/", $this->query)){
            $this->query .= " LIMIT 1";
        }
    }
}
