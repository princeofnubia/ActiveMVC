<?php

class ResetPassword extends Api_endpoints{
	const RESET_SUCCESSFULL = 32;
	const RESET_FAILED = 33;
	public function __construct(){
		parent::__construct();
		$this->isAuthenticated();
	}
	public function index(){
		$this->request_verifier('POST');
		$data = $_POST;
		if ($this->model->resetPassword($data)) {
			$this->report(self::RESET_SUCCESSFULL,true);
		}
		else{
			$this->report(self::RESET_FAILED);
		}
	}
}