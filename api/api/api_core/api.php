<?php

class Api extends Exception{
	const API_ACCESS_DENIED = 00;
	const NO_ENDPOINT_SPECIFIED = 01;
	const INVALID_REQUEST = 02;
	const NO_ENDPOINT_EXIST = 03;
	const ACCESS_DENIED_FOR_REQUEST = 11;		
	protected $api_endpoints_path = "../api/api_endpoints/";
	protected $class;
	protected $method;
	protected $params=[];
	public function __construct(){
		parent::__construct();
		$url = $this->parse_url();	
		try {
			$this->endpoint_caller($url);
		} catch (Exception $e) {
			echo header('Content-Type: application/json; charset=utf8');
			echo json_encode(["reponse"=>"false","body"=>array("source"=>"$_SERVER[SERVER_NAME]", "response_code"=>$e->code,"response_msg"=>$e->message)]);
			
		}
		return true;
	}

	public function parse_url(){
		if (isset($_GET['url'])) {
			return $url = explode("/", filter_var(rtrim($_GET['url']),FILTER_SANITIZE_URL));
		}
	}
	public function endpoint_exception($error_code){
		require_once '../api/api_config/error_msg.php';
		return $response_code[$error_code];
	}

	public function endpoint_caller($url){
		if (!file_exists($this->api_endpoints_path .$url[0].".php")) {
			throw new Exception($this->endpoint_exception(self::INVALID_REQUEST),self::INVALID_REQUEST);		
		}
			$class = ucfirst($url[0]);
			require_once $this->api_endpoints_path .$url[0].".php";
			$this->class = new $class();
			
			unset($url[0]);
			if (!isset($url[1])) {
				$url[1] = "index";	
			}			
			if(method_exists(get_parent_class($this->class), $url[1])){
				throw new Exception($this->endpoint_exception(self::ACCESS_DENIED_FOR_REQUEST),self::ACCESS_DENIED_FOR_REQUEST);
			}
			if (!method_exists($this->class, $url[1])) {
				if ($url[1] == "index") {
					throw new Exception($this->endpoint_exception(self::NO_ENDPOINT_SPECIFIED),self::NO_ENDPOINT_SPECIFIED);
				}
				else{
					throw new Exception($this->endpoint_exception(self::NO_ENDPOINT_EXIST),self::NO_ENDPOINT_EXIST);
				}
				
			}

			$this->method = $url[1];
			unset($url[1]);
			$this->params = $url ? array_values($url) : [];
			call_user_func_array([$this->class,$this->method], $this->params);
	}
	static public function serve_me_api_abeg()
    {
        return new static;
    }
}

