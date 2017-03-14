<?php

class Admin extends Api_endpoints{

	public function __construct(){
		parent::__construct();
		
	}
	public function createAdmin(){
		$this->request_verifier('POST');
		$data = $_POST;
		if ($this->model->createAdmin($data)) {
			$this->report(parent::CREATION_SUCCESSFULL,true);
		}
		else{
			$this->report(parent::CREATE_FAILED);
		}
	}
}