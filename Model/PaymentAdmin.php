<?php
require_once "IPaymentProcessor.php";
require_once 'CreditCardAdaptee.php';
require_once 'PaypalAdaptee.php';
require_once 'PaypalAdapter.php';
require_once 'CreditCardlAdapter.php';

class PaymentAdmin {
    
        public function validatePaybal(string $email, string $password): bool {
            // Check if the email ends with '@paybal.com'
            if (!str_ends_with($email, '@paybal.com')) {
                return false;
            }
    
            // Check if the password is greater than 8 characters
            if (strlen($password) <= 8) {
                return false;
            }
    
            return true; 
        }


    
        public function validateCreditCard(int $cardNumber,int $cvv):bool{
            
            $cardNumberStr = (string)$cardNumber;
            $cvvStr = (string)$cvv;
    
        
            if (strlen($cardNumberStr) !== 16) {
                return false;
            }
    

            if (strlen($cvvStr) !== 3) {
                return false;
            }
    
            return true; 
        }

        
    


}
