<?php
class VerifyEmail extends Api_endpoints{
	public function __construct(){
		parent::__construct();
	}
	public function q($id){
		$this->request_verifier('GET');
		$val = explode("=", $id);
		try {
			$config = $this->config->config_item();											 
			$token = $this->auth->decodeToken($val[1],$config['mail_token_key']);
			$user_data = $this->model->verifyEmail($token->data->email);
            $payload['iat'] = time();
            $payload['jti'] = $config['tokenId'];
            $payload['iss'] = $config['token_issuer'];
            $payload['ntb'] = $payload['iat'] + 10;
            $payload['exp'] = $payload['iat']+$config['token_timeout']; 
            $payload['data']['id'] = $user_data['id'];               
            $payload['data']['email'] = $user_data['email'];
			$token = $this->auth->getToken($payload,$config['token_key']);
			$user_data['token'] = $token;
			return $this->json($user_data);
		} catch (Exception $e) {
			$this->report($e->code,false,$e->message);
		}
	}
}