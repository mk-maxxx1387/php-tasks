<?php 

class Model
{
	private $validate;
	private $post;

   	public function __construct()
   	{
   		$this->validate = new Validate();
   	}
   	
	public function getArray()
	{

		return array(
			'%TITLE%'=>'Contact Form',
			'%ERRORS%'=>'',
			'%NAME%'=>'',
			'%EMAIL%'=>'',
			'%SUBJECT%'=>'',
			'%MESSAGE%'=>'',
			'%IS_SENT%'=>'',
			'%OPTIONS%'=>array('Subj1', 'Subj2', 'Subj3', 'Subj4'),
			);	
    }
	
	public function checkForm()
	{
		$vald = $this->validate;
		$arr = $this->getArray();
		$arr['%NAME%'] = $_POST['full-name'];
		$arr['%EMAIL%'] = $_POST['email'];
		$arr['%SUBJECT%'] = $_POST['subject'];
		$arr['%MESSAGE%'] = $_POST['message'];
		$arr = $vald->checkAll($arr);

		if(empty($arr['%ERRORS%'])){
			return array(true, $arr);
		} else {
			return array(false, $arr);
		}			
	}
   
	public function sendEmail($arr)
	{

		$to  = "<".EMAIL_ADM.">" ; 

		$subject = $arr['%SUBJECT%']; 

		$message = "<p>".$arr['%MESSAGE%']."</p></br>";

		$headers  = "Content-type: text/html; charset=windows-1251 \r\n"; 
		$headers .= "From: <$arr".['%EMAIL%'].">\r\n"; 
		//$headers .= "Reply-To: reply-to@example.com\r\n"; 

		return mail($to, $subject, $message, $headers); 
	}		
}
