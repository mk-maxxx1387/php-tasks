<?php

class Order {
    private $id;
    private $userId;
    private $carId;
    private $firstName;
    private $lastName;
    private $payType;
    
    public function __construct(){
    }
    
    public function getOrderFromPost(){
        $this->userId = $_POST['userId'];
        $this->carId = $_POST['carId'];
        $this->firstName = $_POST['firstName'];
        $this->lastName = $_POST['lastName'];
        $this->payType = $_POST['payType'];
        //validate($this);
        return $this;
    }

    public function getId(){
        return $this->id;
    }
    public function getUserId(){
        return $this->userId;
    }
    public function getCarId(){
        return $this->carId;
    }
    public function getFirstName(){
        return $this->firstName;
    }
    public function getLastName(){
        return $this->lastName;
    }
    public function getPayType(){
        return $this->payType;
    }

    public function setId($id){
        $this->id = $id;
    }
    public function setUserId($userId){
        $this->userId = $userId;
    }
    public function setCarId($carId){
        $this->carId = $carId;
    }
    public function setFirstName($firstName){
        $this->firstName = $firstName;
    }
    public function setLastName($lastName){
        $this->lastName = $lastName;
    }
    public function setPayType($payType){
        $this->payType = $payType;
    }
}
