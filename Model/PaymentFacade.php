<?php
require_once "IPaymentProcessor.php";
require_once 'CreditCardAdaptee.php';
require_once 'PaypalAdaptee.php';
require_once 'PaypalAdapter.php';
require_once 'CreditCardlAdapter.php';

class PaymentFacade {
    private IPaymentProcessor $payment;

    public function __construct(String $type)
    {
        if($type=='Paypal'){
            $this->payment=new PaypalAdapter(new PaypalAdaptee());
        }

        if($type=='CreditCard'){
            $this->payment=new CreditCardAdapter(new CreditCardAdaptee());
        }
    
    

    }

    public function pay(FoodSet $foodSet){

        if($this->payment->makePayment($foodSet->getCost())){

            $foodSet->setPaid(true);

            return true;
        }
        return false;
    }


}
