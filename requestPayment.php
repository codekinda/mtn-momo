<?php
include_once("config.php");
include_once("access_token.php");
if(isset($_POST["pay"])){
	echo$amount = htmlspecialchars($_POST["amount"]);
	echo$customer = htmlspecialchars($_POST["customer"]);
//Payload
$payload = array(
    "amount" => $amount,
    "currency" => "EUR",
    "externalId" => uniqid(),
    "payer" => array(
        "partyIdType" => "MSISDN",
        "partyId" => $customer
    ),
    "payerMessage" => "I am happy to buy this product",
    "payeeNote" => "Thanks for Watching CodeKinda videos! Please, subscribe"
);

//$call_back ="http://localhost/momo/callback.php";
// Set up cURL
$ch = curl_init("https://sandbox.momodeveloper.mtn.com/collection/v1_0/requesttopay");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer " . $access_token,
    "Ocp-Apim-Subscription-Key: " . $secondary_key,
    "X-Target-Environment: sandbox",
    "X-Reference-Id: " . $uuid,
    //"X-Callback-Url: " . $call_back,
    "Content-Type: application/json"
));

// Execute the request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
} else {
    // Get the HTTP status code
   echo $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    // Output the response
    echo $response;
    
    // Check if the request was successful (HTTP status code 201 Created)
  if ($http_code == 202) {
       // echo "API call successful! Response code is " . $http_code;
       // echo "<br>The API User is : " . $uuid;
	  header("Location: push.php");
	  exit;
    } else {
        //echo "API call failed with HTTP code: " . $http_code;
	 header("Location: fail.php");
	   exit;
    }
}

// Close cURL session
curl_close($ch);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Donation Form</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Donate Now</h2>
    <form action="#" method="post">
        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="customer" placeholder="Enter your phone number" required>
        
        <label for="amount">Amount (&euro;):</label>
        <input type="number" id="amount" name="amount" placeholder="Enter donation amount" min="1" required>
        
        <input type="submit" name="pay" value="Donate">
    </form>
</div>

</body>
</html>
