<?php
$url = "localhost/hh/api/organisation/updateOrg";
$ch = curl_init($url);
$data = array("name"=>"adedoja",
"taxInsID"=>"1",
"officeLocation"=>"N0 3 taiwo road ilorin",
"status"=>"paid");
curl_setopt($ch, CURLOPT_PUT, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);

print_r($result);
