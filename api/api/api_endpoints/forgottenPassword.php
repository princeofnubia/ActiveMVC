<?php
class forgottenPassword extends Api_endpoints{
	private $mail_config;
	public function __construct(){
		parent::__construct();
		$this->mail_config = Api_mail::mail_config()->config_item();
	}
	public function index(){
		$this->request_verifier('POST');
		$data = $_POST;
		try {
			$email=$this->model->verifyEmail($data['email']); //verify whether email exist
			$token = $this->createToken($data['email']); // create a token for the user
			return 	$this->json($token);
			//$this->sendVerificationMail($email,$token); // then send a verification to his mail.
		} catch (Exception $e) {
			$this->report($e->code,false,$e->message);
		}
	}
	//token shall be created based on user email
	private function createToken($email){
			$config = $this->config_key();         
            $payload['iat'] = time();
            $payload['jti'] = $config['tokenId'];
            $payload['iss'] = $config['token_issuer'];
            $payload['ntb'] = $payload['iat'] + 10;
            $payload['exp'] = $payload['iat']+$config['mail_token_timeout'];                
            $payload['data']['email'] = $email;
            $token = $this->auth->getToken($payload, $config['mail_token_key']);
         	return $token;
	}
	private function sendVerificationMail($email,$token){
		$transport = Swift_SmtpTransport::newInstance($this->mail_config['host'], $this->mail_config['port'])
		->setUsername($this->mail_config['username'])
		->setPassword($this->mail_config['password']);
		$mailer = Swift_Mailer::newInstance($transport);
		$message = Swift_Message::newInstance()
		->setSubject($this->mail_config['mail_verification'])
		->setFrom($this->mail_config['from'])
		->setTo(array($email=>" "))
		->setBody($this->mail_config['body'])
		->addPart($this->mail_config['verification_endpoint'].$token, 'text/html');
		$result = $mailer->send($message);
	}

}