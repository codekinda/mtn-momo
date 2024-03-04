<?php
$secondary_key = "28af198830c542ac8094e1d1984aa622";
$data = array("providerCallbackHost" => "http://localhost/momo/callback.php");
$apiUser = "ef4d7504-9ea2-44b5-980d-dbbe38109363";
$apiKey = "72bd650e7f86422db3cf81ac757ba8bf";

//UUID Version 4
function generate_uuid(){
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
     $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
     return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
$uuid = generate_uuid();