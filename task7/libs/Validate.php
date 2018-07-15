<?php

class Validate{
	private $err;

	public function __construct()
	{
		$this->err = '';
	}

	public function checkAll($arr)
	{
		$this->checkName($arr['%NAME%']);
		$this->checkEmail($arr['%EMAIL%']);
		$this->checkMessage($arr['%MESSAGE%']);
		$this->checkSubject($arr['%SUBJECT%']);
		$arr['%ERRORS%'] = $this->err;
		return $arr;
	}

	public function checkName($name)
	{
		if(empty($name) || !preg_match('([A-Za-z]{2,10})', $name))
		{
			$this->err .= ER_NAME_FORMAT.'<br>';

		} else {
			return true;
		}
	}

	public function checkEmail($email)
	{
		if(empty($email) || !preg_match('([._a-zA-Z0-9-]+@[.a-zA-Z0-9-]+.[a-z]{2,6})', $email))
		{
			$this->err .= ER_EMAIL.'<br>';

		} else {
			return true;
		}
	}	

	public function checkMessage($message)
	{
		if(empty($message))
		{
			$this->err .= ER_MSG_EMP.'<br>';

		} else {
			return true;
		}
	}

	public function checkSubject($subject)
	{
		if(empty($subject))
		{
			$this->err .= ER_SBJ_EMP.'<br>';

		} else {
			return true;
		}
	}		
}