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
        /*$query = "SELECT * FROM `carshop_cars`";
        if($param){
            $query .= "WHERE id = $param";
        }
        return $this->db->query($query);*/
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
            header('WWW-Authenticate: Basic realm="Restricted area"');
            header('HTTP/1.1 401 Unauthorized');
            exit;
        }
        return $res;
    
        //var_dump($res);
    }
    public function deleteUsers(){}
}

RESTServer::start(new Users());
