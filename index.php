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
    $ismainMenu = true;
} 
else if ($ismainMenu == true && $text == "1"){

    $menu->numberExists();
    $isnumberExists = true;
} 
else if ($isnumberExists = true && $text == "2"){
    $menu->English();
    $isEnglish = true;
} 
else if ($isEnglish = true && $text == "1"){
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
