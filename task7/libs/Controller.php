<?php

class Controller
{
		private $model;
		private $view;
		

		public function __construct()
		{		
		    $this->model = new Model();
			$this->view = new View(TEMPLATE);	
				
			if(isset($_POST['email']))
			{	
				$this->pageSendMail();
			}
			else
			{
				$this->pageDefault();	
			}
			
			$this->view->templateRender();			
	    }	
		
		private function pageSendMail()
		{
			$res = $this->model->checkForm();
			$mArray = $this->model->getArray();
			if($res[0] === true)
			{
				if($this->model->sendEmail($res[1])){
					$mArray['%IS_SENT%'] = 'Message was sent';
				}
			} else {
				$mArray = $res[1];
			}
					
	        $this->view->addToReplace($mArray);	
		}	
			    
		private function pageDefault()
		{   
		   $mArray = $this->model->getArray();		
	       $this->view->addToReplace($mArray);			   
		}				
}
