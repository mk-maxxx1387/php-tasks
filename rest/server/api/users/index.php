<?php

include_once("../libs/RESTServer.php");

class Users 
{
    protected $db;

    public function __construct(){
        $this->db = RESTServer::getDBConn();
    }
    //select
    public function getUsers($param=false){

    }

    public function getUserIdByToken(){

    }
    //insert
    public function postUsers(){
        $username = $_SERVER['PHP_AUTH_USER'];
        $password = $_SERVER['PHP_AUTH_PW'];
        return "$username = $password";
    }
    //update
    public function putUsers(){
        $login = $_SERVER['PHP_AUTH_USER'];
        $pwd = $_SERVER['PHP_AUTH_PW'];
        $query = "
            SELECT id, login, password 
            FROM carshop_users
            WHERE login = ?
            AND password = ?
        ";
        $res = $this->db->query($query, array($login, $pwd));
        
        if(!$res){
            http_response_code(401);
            echo json_encode(array("error" => "Wrong login or password"));
            return;
        } else {
            $token = $this->createToken($res['id']);
            http_response_code(200);
            var_dump(json_encode($_SERVER['Authorization']));
            echo json_encode(array("user_id" => $res['id'], "token" => $token, "login" => $res['login']));
        }

    }
    public function deleteUsers(){}

    public function createToken($userId) {
        $date = date_create();
        $token = sha1(date_timestamp_get($date).$userId);
        $query = "INSERT INTO `carshop_user_tokens` (user_id, token) VALUES (?, ?)";
        $this->db->query($query, array($userId, $token));
        return $token;
    }
}

RESTServer::start(new Users());
