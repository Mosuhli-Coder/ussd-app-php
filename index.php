<?php
include_once 'menu.php'; 

// Read the data sent via POST from our AT API
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];

$menu = new Menu();
$ismainMenu = false;
$isnumberExists = false;
$isEnglish = false;

if ($text == ""){
    echo "CON " . $menu->mainMenu();
} 
else if ($text == "1"){

    echo "CON " . $menu->numberExists();
} 
else if ($text == "1*2"){
    echo "CON " . $menu->English();
} 
else if ($text == "1*2*1"){
    // This is the second level response where the use selected 1 in the first instance of
    $textArray = explode("*", $text);
        switch($textArray[0]){
            case 1: 
                $menu->sendParcelMenu($textArray, $phoneNumber);
            break;
            default:
                echo "END Invalid choice. Please try again";
        }
}

?>
