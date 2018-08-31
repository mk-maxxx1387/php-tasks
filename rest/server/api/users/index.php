<?php

include_once("../libs/RESTServer.php");
include_once("../libs/Token.php");

class Users 
{
    protected $db;

    public function __construct(){
        $this->db = RESTServer::getDBConn();
    }
    //select
    public function getUsers($param=false){

    }
    //insert
    public function postUsers(){
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $login = $_POST['login'];
        $passwd = $_POST['regPassword'];
        $passwdAgin = $_POST['regPasswordRepeat'];
        
        $query = "
            INSERT INTO carshop_users (first_name, last_name, login, password) 
            VALUES (?, ?, ?, ?)
        ";
        $res = $this->db->query($query, array($firstName, $lastName, $login, $passwd));

        http_response_code(200);
        echo json_encode(array("message" => "User was added"));
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
            echo json_encode(array("message" => "Wrong login or password"));
            return;
        } else {
            $token = Token::createToken($res['id']);
            http_response_code(200);
            echo json_encode(array("token" => $token, "login" => $res['login']));
        }

    }
    
    public function deleteUsers(){
        $res = Token::removeToken();
        if($res){
            http_response_code(200);
            echo json_encode(array("message" => "Logout successful"));
        } else {
            http_response_code(401);
            echo json_encode(array("message" => "Token not found"));
        }
    }
}

RESTServer::start(new Users());
