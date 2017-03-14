<?php

class Login extends Api_endpoints{

	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->request_verifier('POST');
		$data = $_POST;
		if ($user_data = $this->model->login($data)) {
			return $this->json($user_data);
		}
		else{
			$this->report(parent::LOGIN_FAIL);
		}
	}

}