<?php

class Singleton {
    private static $instance;

	private $resArray = array();	
    //public $isError;
    //public $msg;

    public static function getInstance()
	{
        if(!self::$instance)
		{
            self::$instance = new Singleton();
        }
        return self::$instance;
    }

    public function __get($key)
	{
		if (array_key_exists($key, $this->resArray)) 
		{
     		return $this->resArray[$key];
		}
    }

    public function __set($key, $value)
	{
        $self->resArray[$key] = $value;
    }

    private function __construct(){}
    private function __clone(){}
    private function __sleep(){}
    private function __wakeup(){}
}
