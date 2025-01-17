<?php
require_once "IPaymentProcessor.php";
require_once 'CreditCardAdaptee.php';
require_once 'PaypalAdaptee.php';
require_once 'PaypalAdapter.php';
require_once 'CreditCardlAdapter.php';
require_once 'Model/FoodSet.php';


require_once 'PaymentAdmin.php';
class PaymentFacade {
    private IPaymentProcessor $payment;
    private PaymentAdmin $validator;

    public function __construct(){
        $this->validator=new PaymentAdmin();
    }
   
    
    

    

    public function pay(String $type,String $email,string $password,int $cardNumber,int $cvv, FoodSet $foodSet){

        if($type=='Paypal'){
            $this->payment=new PaypalAdapter(new PaypalAdaptee($email,$password));
            if($this->validator->validatePaybal($email,$password)){
                $this->payment->makePayment( $foodSet->getCost());
                $foodSet->setPaid(true);
                return true;
            
            }
            

        }

        else if($type=='CreditCard'){
            $this->payment=new CreditCardAdapter(new CreditCardAdaptee($cardNumber, $cvv));
            if($this->validator->validateCreditCard($cardNumber,$cvv)){
                $this->payment->makePayment( $foodSet->getCost());
                return true;
            }
            
            
        
            
        }

        return false;
    }


}
