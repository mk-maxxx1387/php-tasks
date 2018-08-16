<?php

include_once("../libs/RESTServer.php");

class Cars 
{
    public function getCars(){
        return "getCars";
    }
    public function postCars(){}
    public function putCars(){}
    public function deleteCars(){}
}

RESTServer::start(new Cars());
