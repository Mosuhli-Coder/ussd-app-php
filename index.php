<?php
// Reads the variables send via POST from AT gateway
$sessionId = $_POST['sessionId'];
$serviceCode = $_POST['serviceCode'];
$phoneNumber = $_POST['phoneNumber'];
$text = $_POST['text'];

if ($text == ""){
    // This is the first request> Note how we start the response with CON
    $response = "CON Automatic System Check (Check if the phone number exists in the system) \n";
    $response .= "1. Phone number exists \n";
    $response .= "2. Phone number does not exist";
} else if ($text == "1"){
    // Business logic for the first response
    $response = "CON Welcome To Tuma\n Rea go Amogela mo Tuma: \n";
    $response .= "1. Setswana \n";
    $response .= "2. English";
} else if ($text == "1*2"){
    // Business logic for the second response
    // This is the terminal request> Note how we start the response with END
    $response = "CON Welcome, Choose option: \n";
    $response .= "1. Send Parcel\n";
    $response .= "2. Track Parcel\n";
    $response .= "3. Recieve Parcel\n";
    $response .= "4. Bus Schedules\n";
} else if ($text == "1*2*1"){
    // This is the second level response where the use selected 1 in the first instance of
    $level = count($textArray);
    if($level == 1){
        echo "CON Hello CHABAYA Please Enter Parcel Pickup Point \n";
        echo "CON Town/Village:";
   } else if($level == 2){
        echo "CON Hello CHABAYA Please Enter Parcel Pickup Point \n";
        echo "CON Ward:";
   }else if($level == 3){
        echo "CON Hello CHABAYA Please Enter Parcel Pickup Point \n";
        echo "CON Plot.NO:";
   }
    
    $response .= "Town/Village";

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
