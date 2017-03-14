<?php
/* Author Abubakri Olaitan
/* For : Tax Lens Project
/* 
/*******************************************************************************************************/
/*																										
**	I salted the password with this key. Once set please dont change otherwise user wont be able to login
** 	If you dont want this just removed the string concatenated with the password from the sourcefile api\api_core\api_model\salt()
*/
$config['encryption_key'] = '#KNIO#akiao323024ndon0@023!KMapQNAS_@E#_(!WPMSQ:MP@O_)I@_EM';

/*
** set values for the payload in other to generate token. We dont want to hardcode that	
*/
$config['token_key'] = '8yb08yfs12345678'; //key for token signature
$config['algorithm'] = array('HS256'); //our algorithm for generating token
$config['token_timeout'] = 600; //set timeout in seconds for a token so they will be logged on for only that seconds
$config['token_issuer'] = $_SERVER['SERVER_NAME']; //who is issuing the token to us
$config['tokenId']  = base64_encode(mcrypt_create_iv(32)); //creatig unique identifiers for the token
$config['mail_token_key'] = 'odinnweinfowinrfoiwnfo'; //token key for forgotpassword
$config['mail_token_timeout'] = 3000; //token key for forgotpassword


?>