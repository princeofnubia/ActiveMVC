<?php
class Login_model extends Api_model {
    protected $table = 'User';
    protected $fillable = ["email","password","createdBy","userType","userRelatesTo","status"];
    public function __construct(){
        parent::__construct();
    }

    public function login($data){
        try {
        	$data['password'] = $this->salt($data['password']);
            $user_details = self::where('password', $data['password'])->where('email', $data['email'])->first();
            if ($user_details) {
            	unset($user_details['password']);
                $config = $this->config_key();
                $payload['iat'] = time();
                $payload['jti'] = $config['tokenId'];
                $payload['iss'] = $config['token_issuer'];
                $payload['ntb'] = $payload['iat'] + 10;
                $payload['exp'] = $payload['iat']+$config['token_timeout']; 
                $payload['data']['id'] = $user_details['id'];               
                $payload['data']['email'] = $user_details['email'];
                $token = $this->auth->getToken($payload, $config['token_key']);
                $user_details['token'] = $token;
            }
            else{
                return $user_details = false;
            }

        } catch (Exception $e) {
           $this->model_error_report($e);
        }
        return $user_details;  
    }

}
