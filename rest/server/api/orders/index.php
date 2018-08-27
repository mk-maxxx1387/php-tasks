<?php
include_once("../libs/RESTServer.php");
include_once("../libs/Order.php");
include_once("../libs/Token.php");

class Orders {
    protected $db;

    public function __construct(){
        $this->db = RESTServer::getDBConn();
    }

    public function getOrders($param=false){
        $userId = Token::getUserIdByToken();
      
        if(false == $userId){
            http_response_code(401);
            echo json_encode(array("message" => "You are not authorized. Please log in!"));
            return;
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
            http_response_code(200);
            echo json_encode($res);
        } else{
            http_response_code(204);
            echo json_encode(array("message" => "Empty result"));
        }
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

        $query = "
            INSERT INTO `carshop_orders`(car_id, user_id, first_name, last_name, pay_type) 
            VALUES (?, ?, ?, ?, ?)";
        return $this->db->query($query, $data);
    }

    public function putOrders(){}

    public function deleteOrders(){}
}

RESTServer::start(new Orders());