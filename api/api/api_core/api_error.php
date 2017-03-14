<?php
// use config variable as class rather than requiring it all the time
class Api_error {
	public function __construct(){
	}
	public function error_response(){
		require_once "../api/api_config/error_msg.php";
			return $response_code;
	}
 	static public function error(){
		return new static;
	}
}