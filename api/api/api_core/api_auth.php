<?php
use \Firebase\JWT\JWT as JWT;
use Illuminate\Database\Eloquent\Model as Eloquent; 
class Api_auth extends Eloquent
{
	const ACCESS_DENIED = 24;
	const NO_TOKEN = 25;
	const INVALID_USER = 26;
	protected $config;
	protected $response_code;
	protected $table = 'User';
	public function __construct(){		
		$this->config = new Api_config();
		$this->response_code = new Api_error();
	}

	protected function config_key(){
		return $this->config->config_item();
	}
	protected function report($code,$flag = null, $message = null){
			$flag = isset($flag) ? $flag : false;
			$response = $this->response_code->error_response();
			$response = isset($message) ? $message : $response[$code];
			header('Content-Type: application/json; charset=utf8');
			echo json_encode(["reponse"=>$flag,"body"=>array("source"=>"$_SERVER[SERVER_NAME]", "response_code"=>"$code","response_msg"=>"$response")]);
			exit;
	}
	public function isAuthenticated(){
		$headers = getallheaders();
		if (isset($headers['Authorization'])) {
			$jwt = $headers['Authorization'];
			$jwt = explode(" ",$jwt);
			$token = $jwt[1];
			$config = $this->config_key();
			$payload = $this->decodeToken($token,$config['token_key']);
			if (is_object($payload)) {
				$data = $payload->data;
				$user_details = self::where('id', $data->id)->where('email', $data->email)->first();
				if (!$user_details) {
					throw new Exception($this->report(self::INVALID_USER));	
				}
				else{
					return true;
				}
			}
			else{
				throw new Exception($this->report(self::ACCESS_DENIED),self::ACCESS_DENIED);
			}
		}
		else{
			throw new Exception($this->report(self::NO_TOKEN),self::NO_TOKEN);
		}

	}
	public function decodeToken($token,$key){
		$payload = JWT::decode($token,$key,array('HS512'));
		return $payload;
	}
	public function getToken($payload, $key){
    	$token = JWT::encode($payload,$key,'HS512');
    	return $token;
    }
	static public function auth(){
		return new static;
	}

}