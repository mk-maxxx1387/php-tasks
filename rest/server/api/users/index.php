<?php

include_once("../libs/RESTServer.php");
include_once("../libs/Token.php");
include_once("../libs/Validate.php");

class Users 
{
    protected $db;

    public function __construct(){
        $this->db = RESTServer::getDBConn();
    }

    public function postUsers(){
        $validate = new Validate();
        $result = $validate->validateRegister();
        
        if(is_string($result)){
            return array("code" => 400, "data" => $result);
        }

        $query = "
            INSERT INTO carshop_users (first_name, last_name, login, password) 
            VALUES (?, ?, ?, ?)
        ";
        $res = $this->db->query($query, $result);

        return array("code" => 200, "data" => array("message" => "User was added"));
    }

    public function putUsers(){
        $validate = new Validate();
        $result = $validate->validateLogin();
        
        $query = "
            SELECT id, login, password 
            FROM carshop_users
            WHERE login = ?
            AND password = ?
        ";
        $res = $this->db->query($query, $result);
        
        if(!$res){
            return array("code" => 401, "data" => "Wrong login or password");
        } else {
            $token = Token::createToken($res['id']);
            return array("code" => 200, "data" => array("token" => $token, "login" => $res['login']));
        }

    }
    
    public function deleteUsers(){
        $res = Token::removeToken();
        if($res){
            return array("code" => 200, "data" => array("message" => "Logout successful"));
        } else {
            return array("code" => 401, "data" => "Token not found. Please, login");
        }
    }
}

RESTServer::start(new Users());
