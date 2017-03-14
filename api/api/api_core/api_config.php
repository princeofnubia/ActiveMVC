<?php
// use config variable as class rather than requiring it all the time
class Api_config {
	public function __construct(){
	}
	public function config_item(){
		require "../api/api_config/config.php";
			return $config;
	}
	static public function config(){
		return new static;
	}

}