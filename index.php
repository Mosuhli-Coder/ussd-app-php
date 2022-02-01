<?php
// Reads the variables send via POST from AT gateway
$sessionId = $_POST['sessionId'];
$serviceCode = $_POST['serviceCode'];
$phoneNumber = $_POST['phoneNumber'];
$text = $_POST['text'];

if ($text == ""){
    // This is the first request> Note how we start the response with CON
    $response = "CON what would you want to check \n";
    $response = "1. My Account No \n";
    $response = "2. My Phone Number";
} else if ($text == "1"){
    // Business logic for the first response
    $response = "CON Choose account information you want to view \n";
    $response = "1. My Account Nnumber \n";
    $response = "2. Account Balance";
}


?>