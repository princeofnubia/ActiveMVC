<?php
use Illuminate\Database\Eloquent\Model as Eloquent; 
class Api_model extends Eloquent
{
	const ERR_POST_VAR = 14;
	public $timestamps = false;
	protected $response_code ;
	private $config;
	protected $model_path = "../api/api_model/";
	protected $auth;
	public function __construct(){
		$this->response_code = Api_error::error();
		$this->config = Api_config::config();
		$this->auth = Api_auth::auth();
	}
	
	protected function model_error_report($e){
		echo header('Content-Type: application/json; charset=utf8');
		echo json_encode(array("response_code"=>$e->code,"response_msg"=>$e->message));
	}

	private function model($model){
		$model = lcfirst($model);
		try {
			$this->path_check($model);
		} catch (Exception $e) {
			echo $e->message;
		}
		$model = ucfirst($model);
		return new $model();

	}
	protected function config_key(){
		return $this->config->config_item();
	}
	protected function report($code){
		$response = $this->response_code->error_response();
		$response = ($response[$code]);
	    header('Content-Type: application/json; charset=utf8');
		echo json_encode(["body"=>array("source"=>"$_SERVER[SERVER_NAME]", "response_code"=>"$code","response_msg"=>"$response"),"reponse"=>"false"]);
	}
	private function path_check($path){
		$path = $this->model_path."$path.php";
		if (!file_exists($path)) {
			throw new Exception("model does not exist");
		}
		require_once $path;
	}
	protected function salt($password)
	{	
		$config = $this->config_key();
		return hash("sha512", $config['encryption_key'].$password);	//you can clear out $config['encryption_key'] if you do not want a salted password
	}

}