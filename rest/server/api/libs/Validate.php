<?php

class Validate{
    public static $error;

    public function validateOrder($userId){
        self::$error = '';

        $this->validateNum($_POST['carId'], "Car id");
        $this->validateNum($userId, "User id");
        $this->validateText($_POST['firstName'], "First name");
        $this->validateText($_POST['lastName'], "Last name");
        $this->validateNum($_POST['payType'], "Pay type");

        if(self::$error == ''){
            return array($_POST['carId'], $userId, $_POST['firstName'], $_POST['lastName'], $_POST['payType']);
        } else {
            return self::$error;
        }

    }

    public function validateRegister()
    {
        self::$error = '';

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $login = $_POST['login'];
        $passwd = $_POST['regPassword'];
        $passwdAgin = $_POST['regPasswordRepeat'];

        $this->validateText($firstName, "First name");
        $this->validateText($lastName, "Last name");
        $this->validateTextNum($login, "Login");
        $pwd = $this->validateTextNum($passwd, "Password");
        $pwdAgin = $this->validateTextNum($passwdAgin, "Password repeat");
        
        if($pwd && $pwdAgin){
            $this->validatePassEqual($passwd, $passwdAgin);
        }

        if(self::$error == ''){
            return array($firstName, $lastName, $login, $passwd);
        } else {
            return self::$error;
        }
    }

    public function validateLogin(){
        self::$error = '';

        $login = $_SERVER['PHP_AUTH_USER'];
        $pwd = $_SERVER['PHP_AUTH_PW'];

        $this->validateTextNum($login, "Login");
        $this->validateTextNum($pwd, "Password");

        if(self::$error == ''){
            return array($login, $pwd);
        } else {
            return self::$error;
        }
    }

    public function validateText($text, $fieldName){
        if(!is_null($text) && isset($text)){
            if(preg_match('[A-Za-z0-9]{2,50}', $text)){
                return true;
            }
        } else {
            self::$error = "Wrong $fieldName format. Only latin letters. Lenght between 2 and 65 symbol";
            return false;
        }
    }

    public function validateTextNum($textNum, $fieldName){
        if(!is_null($textNum) && isset($textNum)){
            if(preg_match('[A-Za-z0-9]{4,50}', $textNum)){
                return true;
            }
        }
        self::$error = "Wrong $fieldName format. Only latin letters and numbers. Lenght between 2 and 65 symbol";
        return false;
    }

    public function validateNum($num, $fieldName){
        if(!is_null($num) && isset($num)){
            if(preg_match('[0-9]{1,11}', $num)){
                return true;
            }
        }
        self::$error = "Wrong $fieldName format. Only numbers. Lenght between 1 and 11 symbol";
        return false;
    }

    public function validatePassEqual($pass, $passAgin){
        if($pass === $passAgin){
            return true;
        } else {
            self::$error = "Repeated password isn`t equal.";
            return false;
        }
    }
}
