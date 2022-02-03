<?php
// Reads the variables send via POST from AT gateway
$sessionId = $_POST['sessionId'];
$serviceCode = $_POST['serviceCode'];
$phoneNumber = $_POST['phoneNumber'];
$text = $_POST['text'];

if ($text == ""){
    // This is the first request> Note how we start the response with CON
    $response = "CON what would you want to check \n";
    $response .= "1. My Account No \n";
    $response .= "2. My Phone Number";
} else if ($text == "1"){
    // Business logic for the first response
    $response = "CON Choose account information you want to view \n";
    $response .= "1. My Account Nnumber \n";
    $response .= "2. Account Balance";
} else if ($text == "2"){
    // Business logic for the second response
    // This is the terminal request> Note how we start the response with END
    $response = "END Your phone number is ".$phoneNumber;
} else if ($text == "1*1"){
    // This is the second level response where the use selected 1 in the first instance of
    $accountNumber = "ACC1001";

    // This is a terminal request . Note how we start with END
    $response = "END Your account number is ".$accountNumber;
} else if ($text == "1*2"){
    // This is a second level response where the use selected 2 in the first instance
    $balance = "KES 10 000";

    // This is a terminal request. Note how we start with END
    $response = "END Your account number is ".$balance;
}
// echo the response to the API. The response depends on the statement that is fulfilled in each instance
header('Content-type: text/plain');
echo $response;
?>
