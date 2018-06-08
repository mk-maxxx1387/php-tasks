<?php

class Singleton {
    private static $instance;

    public $isError;
    public $msg;

    public static function getInstance(){
        if(!(self::$instance instanceof self)){
            self::$instance = new self();
        }
        return self::$instance;
    }

/*    public function __get($key){
        return $this->vals[$key];
    }

    public function __set($key, $value){
        $this->vals[$key] = $value;
    }
*/
    private function __construct(){}
    private function __clone(){}
    private function __sleep(){}
    private function __wakeup(){}
}
