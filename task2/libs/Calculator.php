<?php

class Calculator {

    private $a;
    private $b;
    private $error;

    public function __construct(){
        $this->error = false;
    }

    public function callMethod($method, $args = null){
        $this->error = $this->validate($method);
        if($args != null){
            return $this->$method($args);
        }
        return $this->$method();
    }

    public function getA(){
        return $this->a;
    }

    public function getB(){
        return $this->b;
    }

    public function setA($a){
        $this->a = $a;
    }

    public function setB($b){
        $this->b = $b;
    }

    private function validate($method){
        $a = $this->a;
        $b = $this->b;

        if(!isset($a) || !is_numeric($a)){
            return ERR_1;
        }

        if(!isset($b) || !is_numeric($b)) {
            return ERR_2;
        }

        if($method == 'division' && $b == 0){
            return ERR_3;
        }

        if($method == 'square' && $a < 0){
            return ERR_4;
        }

        return false;
    }

    private function add(){
        $a = $this->a;
        $b = $this->b;

        if($this->error === false){
            return $a + $b;
        }

        return $this->error;
    }

    private function substract(){
        $a = $this->a;
        $b = $this->b;

        if($this->error === false){
            return $a - $b;
        }

        return $this->error;
    }

    private function multiply(){
        $a = $this->a;
        $b = $this->b;

        if($this->error === false){
            return $a*$b;
        }

        return $this->error;
    }

    private function division(){
        $a = $this->a;
        $b = $this->b;

        if($this->error === false){
            return $a / $b;
        }

        return $this->error;
    }

    private function square(){
        if($this->error === false){
            return sqrt($this->a);
        }

        return $this->error;
    }

    private function persent(){
        if($this->error === false){
            return ($this->a / 100) * $this->b;
        }

        return $this->error;
    }
}
