<?php
    class Menu{
        protected $text;
        protected $sessionId;

        function __construct(){}

        public function mainMenu(){
            //shows initial user menu for registered users
            $response = "Automatic System Check (Check if the phone number exists in the system) \n";
            $response .= "1. Phone number exists \n";
            $response .= "2. Phone number does not exist\n";
            return $response;
        }
        public function numberExists(){
            //shows initial user menu for registered users
            $response = "CON Welcome To Tuma\n Rea go Amogela mo Tuma: \n";
            $response .= "1. Setswana \n";
            $response .= "2. English\n";
            return $response;
        }
        public function English(){
            //shows initial user menu for registered users
            $response = "CON Welcome, Choose option: \n";
            $response .= "1. Send Parcel\n";
            $response .= "2. Track Parcel\n";
            $response .= "3. Recieve Parcel\n";
            $response .= "4. Bus Schedules\n";
            return $response;
        }

        public function sendParcelMenu($textArray, $phoneNumber){
          //building menu for user registration 
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
        }

        public function sendMoneyMenu($textArray, $senderPhoneNumber){
            //building menu for user registration 
            $level = count($textArray);
            $receiver = null;
            $nameOfReceiver = null;
            $response = "";
            if($level == 1){
                echo "CON Enter mobile number of the receiver:";
            }else if($level == 2){
                echo "CON Enter amount:";
            }else if($level == 3){
                echo "CON Enter your PIN:";
            }else if($level == 4){
                $receiverMobile = $textArray[1];
                $receiverMobileWithCountryCode = $this->addCountryCodeToPhoneNumber($receiverMobile);
                
                $response .= "Send " . $textArray[2] . " to <Put a person's name here> - " . $receiverMobile . "\n";
                $response .= "1. Confirm\n";
                $response .= "2. Cancel\n";
                $response .= Util::$GO_BACK . " Back\n";
                $response .= Util::$GO_TO_MAIN_MENU .  " Main menu\n";
                echo "CON " . $response;
            }else if($level == 5 && $textArray[4] == 1){
                //a confirm
                //send the money plus
                //check if PIN correct
                //If you have enough funds including charges etc..
                $pin = $textArray[3];
                $amount = $textArray[2];

                //connect to DB
                //Complete transaction

                echo "END We are processing your request. You will receive an SMS shortly";


            }else if($level == 5 && $textArray[4] == 2){
                //Cancel
                echo "END Canceled. Thank you for using our service";
            }else if($level == 5 && $textArray[4] == Util::$GO_BACK){
                echo "END You have requested to back to one step - re-enter PIN";
            }else if($level == 5 && $textArray[4] == Util::$GO_TO_MAIN_MENU){
                echo "END You have requested to back to main menu - to start all over again";
            }else {
                echo "END Invalid entry"; 
            }
        }

        public function withdrawMoneyMenu($textArray){
            //TODO
            echo "CON To be implemented";
        }

        public function checkBalanceMenu($textArray){
            echo "CON To be implemented";
        }

        public function addCountryCodeToPhoneNumber($phone){
            return Util::$COUNTRY_CODE . substr($phone, 1);
        }

public function middleware($text){
    //remove entries for going back and going to the main menu
    return $this->goBack($this->goToMainMenu($text));
}

        public function goBack($text){
            //1*4*5*1*98*2*1234
            $explodedText = explode("*",$text);
            while(array_search(Util::$GO_BACK, $explodedText) != false){
                $firstIndex = array_search(Util::$GO_BACK, $explodedText);
                array_splice($explodedText, $firstIndex-1, 2);
            }
            return join("*", $explodedText);
        }

        public function goToMainMenu($text){
            //1*4*5*1*99*2*1234*99
            $explodedText = explode("*",$text);
            while(array_search(Util::$GO_TO_MAIN_MENU, $explodedText) != false){
                $firstIndex = array_search(Util::$GO_TO_MAIN_MENU, $explodedText);
                $explodedText = array_slice($explodedText, $firstIndex + 1);
            }
            return join("*",$explodedText);
        }
    }
?>