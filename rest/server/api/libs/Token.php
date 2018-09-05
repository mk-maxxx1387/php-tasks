<?php

include_once("../libs/RESTServer.php");

class Token 
{
    public static function createToken($userId) {
        $db = RESTServer::getDBConn();
        $date = date_create();
        $token = sha1(date_timestamp_get($date).$userId);
        $query = "
            INSERT INTO `carshop_user_tokens` (user_id, token) 
            VALUES (?, ?)
            ";
        $db->query($query, array($userId, $token));
        return $token;
    }

    public static function getUserIdByToken(){
        $db = RESTServer::getDBConn();
        $headers = getallheaders();
        $authToken = $headers['Authorization'];
        
        $query = "
            SELECT user_id
            FROM `carshop_user_tokens`
            WHERE token = ?";
        $res = $db->query($query, array($authToken));
        
        if($res){
            return $res['user_id'];
        } else {
            return false;
        }
    }

    public static function removeToken()
    {
        $db = RESTServer::getDBConn();
        $headers = getallheaders();
        $authToken = $headers['Authorization'];
        var_dump($authToken);
        $query = "
            DELETE FROM `carshop_user_tokens`
            WHERE token = ? 
        ";
        $res = $db->query($query, array($authToken));
        return $res;
    }
}
