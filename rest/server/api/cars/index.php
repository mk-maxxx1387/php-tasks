<?php

include_once("../libs/RESTServer.php");

class Cars 
{
    protected $db;

    public function __construct(){
        $this->db = RESTServer::getDBConn();
    }
    //select
    public function getCars($param=false){
        $query = "SELECT * FROM `carshop_cars`";
        if($param){
            $query .= "WHERE id = $param";
        }
        $res = $this->db->query($query);
        if($res){
            return array("code" => 200, "data" => $res);
        } else{
            return array("code" => 404, "data" => "Data not found");
        }
        
    }
    //insert
    public function postCars(){}
    //update
    public function putCars(){}
    public function deleteCars(){}
}

RESTServer::start(new Cars());
