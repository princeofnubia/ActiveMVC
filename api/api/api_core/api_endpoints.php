<?php

class Api_endpoints extends Exception
{
	const CREATION_SUCCESSFULL = 8;
	const UPDATE_SUCCESSFULL = 9;
	const DELETE_SUCCESSFULL = 10;
	const CREATE_FAILED = 5;
	const UPDATE_FAILED = 6;
	const DELETE_FAILED = 7;
	const FETCH_ERROR = 4;
	const REQUEST_UNSUPPORTED = 12;
	const NO_RECORDS = 13;
	const FAIL = 2;
	const LOGIN_FAIL = 23;
	const ACCESS_DENIED = 24;
	const NO_USER = 35;

	protected $request_method; 
	protected $model;
	protected $model_path = "../api/api_model/";
	protected $config;
	protected $response_code;
	protected $auth;
	public function __construct(){		
		$this->request_method = $_SERVER['REQUEST_METHOD'];
		$this->model = Api_endpoints::model_call(get_called_class()."_model");
		$this->config = Api_config::config();
		$this->response_code = Api_error::error();
		$this->auth = Api_auth::auth();		
	}
	
	private function model_call($model=NULL){
		$model = lcfirst($model);
		try {
			$this->path_check($model);
		} catch (Exception $e) {
			echo $e->message;
		}
		$model = ucfirst($model);
		return new $model();

	}

	private function path_check($path){
		$path = $this->model_path."$path.php";
		if (!file_exists($path)) {
			throw new Exception("model does not exist");
		}
		require_once $path;
	}
	protected function config_key(){
		return $this->config->config_item();
	}
	protected function report($code,$flag = null,$message = null){
			$flag = isset($flag) ? $flag : false;
			$response = $this->response_code->error_response();
			$response = isset($message) ? $message : $response[$code];
			header('Content-Type: application/json; charset=utf8');
			echo json_encode(["reponse"=>$flag,"body"=>array("source"=>"$_SERVER[SERVER_NAME]", "response_code"=>"$code","response_msg"=>"$response")]);
			exit;
	}
	protected function json($data){
			$response = ["response" => true, "body" => $data];
			echo header('Content-Type: application/json; charset=utf8');
			echo json_encode($response);
	}
	protected function request_verifier($expected_method){
		if ($this->request_method == $expected_method) {
			return true;
		}
		else{
			die($this->report(self::REQUEST_UNSUPPORTED));
		}
	}
	public function isAuthenticated(){
		$this->auth->isAuthenticated();
	}
}