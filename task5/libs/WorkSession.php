<?php

class WorkSession implements iWorkData{

    public function __construct(){
        //session_start();
    }

    public function getData($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        } else {
            return FALSE;
        }
    }

    public function deleteData($key){
        if(isset($_SESSION[$key])){
             unset($_SESSION[$key]);
        }
        if(!isset($_SESSION[$key])){
            return TRUE;
        }
        return FALSE; 
    }

    public function saveData($key, $value){
        $_SESSION[$key] = $value;
        return $_SESSION[$key];
    }
}
