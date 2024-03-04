<?php
$secondary_key = "xxxxxxxxxxxxx";
$data = array("providerCallbackHost" => "http://localhost/momo/callback.php");
$apiUser = "xxxxxxxxxxxxxxxxxx";
$apiKey = "xxxxxxxxxxxxxxxxxxx";

//UUID Version 4
function generate_uuid(){
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
     $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
     return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
$uuid = generate_uuid();
