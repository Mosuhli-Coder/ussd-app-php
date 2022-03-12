<?php
include_once 'menu.php'; 
// Reads the variables send via POST from AT gateway
$sessionId = $_POST['sessionId'];
$serviceCode = $_POST['serviceCode'];
$phoneNumber = $_POST['phoneNumber'];
$text = $_POST['text'];

$menu = new Menu();

if ($text == ""){
    $menu->mainMenu();
} else if ($menu->mainMenu() && $text == "2"){
    $menu->numberExists();
} else if ($menu->numberExists() && $text == "2"){
    $menu->English();
} else if ($menu->English() && $text == "1"){
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
