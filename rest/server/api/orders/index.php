<?php
include_once("../libs/RESTServer.php");
include_once("../libs/Token.php");
include_once("../libs/Validate.php");

class Orders {
    protected $db;

    public function __construct(){
        $this->db = RESTServer::getDBConn();
    }

    public function getOrders($param=false){
        $userId = Token::getUserIdByToken();
      
        if(false == $userId){
            return array("code" => 401, "data" => array("message" => "You are not authorized. Please log in!"));
        }

        $query = "
            SELECT c.mark, c.model, c.year, c.price, o.pay_type
            FROM carshop_orders o 
            INNER JOIN carshop_cars c 
            ON o.car_id = c.id
            WHERE user_id = ?  
        ";
        
        $res = $this->db->query($query, array($userId), 'many');

        if($res){
            return array("code" => 200, "data" => $res);
        } else if(count($res) == 0){
            return array("code" => 204, "data" => "Empty result");
        }
    }

    public function postOrders(){
        $userId = Token::getUserIdByToken();
        $validate = new Validate();
        $result = $validate->validateOrder($userId);

        if(is_string($result)){
            return array("code" => 400, "data" => $result);
        }

        $query = "
            INSERT INTO `carshop_orders`(car_id, user_id, first_name, last_name, pay_type) 
            VALUES (?, ?, ?, ?, ?)";
        $res = $this->db->query($query, $result);

        return array("code" => 200, "data" => "Order was added");
    }
}

RESTServer::start(new Orders());