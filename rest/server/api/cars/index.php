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
        echo json_encode($this->db->query($query));
    }
    //insert
    public function postCars(){}
    //update
    public function putCars(){}
    public function deleteCars(){}
}

RESTServer::start(new Cars());
