<?php
include_once("../libs/RESTServer.php");
include_once("../libs/Order.php");

class Orders {
    protected $db;

    public function __construct(){
        $this->db = RESTServer::getDBConn();
    }

    public function getOrders($param=false){
        $query = "SELECT * FROM `carshop_orders`";
        if($param){
            $data = array($param);
            $query .= "WHERE user_id = ?";
            return $this->db->query($query, $data);
        }
        return $this->db->query($query);
    }

    public function postOrders(){
        $order = new Order();
        $order->getOrderFromPost();

        $data = array(
            $order->carId,
            $order->userId, 
            $order->firstName,
            $order->lastName,
            $order->payType
        );

        $query = "INSERT INTO `carshop_orders`(car_id, user_id, first_name, last_name, pay_type) 
                VALUES (?, ?, ?, ?, ?)";
        return $this->db->query($query, $data);
    }

    public function putOrders(){}

    public function deleteOrders(){}
}
