<?php

    $config = [
    //please if you are using google smtp use your account details or create extra for it
    //set the values accordingly.

    'driver' => 'smtp',

    'host' => 'smtp.google.com',//'smtp.google.com'. You can use google smtp or ssmtp if smtp doesnt work

    'port' =>  465, //'smtp.google.com' 465 on google

    'from' => 'abubakrilaitan@gmail.com', //your email

    'encryption' => 'tls',

    'username' => 'username',//your gmail mail or email of whichever host

    'password' => 'password',
    'body' => "Please click on the link below to reset your password.",
    'verification_endpoint' => "verifyEmail/q=",//the url to the endpoint. it must be prepended by base url say domain.wteva/verifyEmail/q=
    'sendmail' => '/usr/sbin/sendmail -bs',
    'mail_verification' => 'Mail verification'

];
