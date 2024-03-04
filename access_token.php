<?php
include_once("config.php");
//Init curl
$ch = curl_init("https://sandbox.momodeveloper.mtn.com/collection/token/");
//Set to POST Method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			
//Encode the POSTED data
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(""));
			
//Return data
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
//Set the headers for the endpoint
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Basic " . base64_encode($apiUser . ":" . $apiKey),
            "Ocp-Apim-Subscription-Key: " . $secondary_key,
            "Content-Type: Application/json"
			));
//Execute the cURL session
$request = curl_exec($ch);
$response = json_decode($request);
$access_token = $response ->access_token;
//var_dump($request);
if(curl_errno($ch)){
echo "cURL returned some errors: " . curl_error($ch);
} else{
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
   // echo $request;
    //var_dump($request);
   /* if($http_code == 200){
        echo"Api call was succssful and the code is" . $http_code;
    }else{
        echo"The API call faile. The code is : " . $http_code;
    }*/
}

?>