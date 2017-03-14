<?php

require_once 'vendor/autoload.php';
require_once 'database.php';
spl_autoload_register(function ($api) {
    require_once 'api_core/' . $api . '.php';
});


$client = Api::serve_me_api_abeg();
