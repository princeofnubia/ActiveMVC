<?php
require_once 'api_config/database.php';

use Illuminate\Database\Capsule\Manager as Db;

$Db = new Db();
$Db->addConnection($config);
$Db->bootEloquent();