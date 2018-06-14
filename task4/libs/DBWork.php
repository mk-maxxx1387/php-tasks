<?php

class DBWork {
    protected $table;
    protected $fields;
    protected $vals;
    protected $query;

    
    /*public function setVals($vals){
        if($this->ifArray($vals)){
            $this->vals = $vals;
            return $this;
        }
        echo "Values aren`t set";
        return FALSE;
    }*/

    public function select(){
        $this->query = "SELECT ";
        return $this;
    }
    
    public function distinct(){
        $this->query .= 'DISTINCT ';
        return $this;
    }

    public function addFields($fields){
        if($this->ifFields($fields)){
            $this->query .= implode(",", $fields);
        }
        return $this;
    }

    public function from($table){

        if($this->ifTable($table)){
            $this->query .= " FROM $table";
        }
        return $this;
    }

    public function where($field, $oper){
        if(!$this->ifName($field) 
        || !$this->ifOper($oper)){
            echo "Where failed.";
            return FALSE;
        }
        $this->query .= " WHERE $field $oper ?";
        return $this;
    }

    public function limit($limit){
        if(is_int($limit)){
            $this->query .= " LIMIT $limit"; 
        }
        return $this;
    }

    public function orderBy($fields, $order){
        if($this->ifFields($fields) && $this->ifOrder($order)){
            $this->query .= " ORDER BY ";
            $this->addFields($fields);
            $this->query .= " $order";
        }
        return $this;
    }
    
    public function groupBy(){
        //if($this->ifFields($fields)){
            $this->query .= " GROUP BY ";
            /*if($this->ifAgr($agr)){
                $this->query .= $agr."(";
                
            }
            $this->addFields($fields);*/
        }
        return $this;
    }

    public function agr($funct, $field, $isFirst = false){
        if($this->ifName($field) && $this->ifAgr($funct)){
            $this->query .= "$funct($field)";
            if($isFirst){
                $this->query .= ",";
            }
        }
        return $this;
    }


    public function insertInto($table, $fields){
        $this->query = '';
        if($this->ifTable($table) && $this->ifFields($fields)){
            $this->query = "INSERT INTO $table(";
            $this->addFields($fields);
            $this->query .= ") VALUES(";

            foreach($fields as $key => $val){
                $fields[$key] = "?";
            }
            $this->query .= implode(",", $fields).") ";
        }
        return $this;
    }

    public function update($table){
        if($this->ifTable($table)){
            $this->query = "UPDATE $table ";
        }

        return $this;
    }

    public function set($fields){
        if($this->ifFields($fields)){
            foreach($fields as $key => $val){
                $fields[$key] = $val." = ? ";
            }
            $this->query .= "SET ".implode(",",$fields);
        }
        return $this;
    }

    public function del(){
        $this->query = "DELETE ";
        return $this;
    }

    protected function queryEnd(){
        $this->query .= ';';
    }

    /*public function ifVals(){
        if(!isset($this->vals)){
            echo "Values aren`t set. ";
            return FALSE;
        }
        return TRUE;
    }*/

    public function ifTable($name){
        if(!preg_match("/^[A-Za-z_-]{3,12}$/", $name)){
            echo "'$name': Wrong table name.";
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function ifFields($fields){
        if(!$this->ifArray($fields)){
            echo "Set fields failed. ";
            return FALSE;
        }
        foreach($fields as $fld){
            if(!$this->ifName($fld)){
                return FALSE;
            }
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
        $field = "[A-Za-z-_]{2,12}";
        if(!preg_match("/^($field|$field.$field)$/", $name)){
            echo "'$name': Wrong field name";
            return FALSE;
        }
        return TRUE;
    }

    public function ifOper($op){
        $opers = array("=", "!=", ">", "<", "<=", ">=");
        if(!in_array($op, $opers)){
            echo "Wrong operator. Only =, !=, >, <, <=, >=.";
            return FALSE;
        }
        return TRUE;
    }
    
    public function ifOrder($ord){
        $orders = array("ASC", "DESC");
        if(!in_array($ord, $orders)){
            echo "Wrong order. Only ASC or DESC.";
            return FALSE;
        }
        return TRUE;
    }

    public function ifAgr($f){
        $funcs = array("COUNT", "AVG", "SUM");
        if(!in_array($f)){
            echo "Wrong agregate function. Only COUNT, AVG, SUM";
            return FALSE;
        }
        return TRUE;
    }
}
