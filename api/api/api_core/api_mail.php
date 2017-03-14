<?php
// use config variable as class rather than requiring it all the time
class Api_mail {
	public function __construct(){
	}
	public function config_item(){
		require "../api/api_config/mail.php";
		return $config;
	}
	static public function mail_config(){
		return new static;
	}

}