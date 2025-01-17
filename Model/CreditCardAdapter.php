<?php


require_once 'IPaymentProcessor.php';
require_once 'CreditCardAdaptee.php';

class CreditCardAdapter implements IPaymentProcessor {
    private $adaptee;

    public function __construct(CreditCardAdaptee $adaptee) {
        $this->adaptee = $adaptee;
    }

    public function makePayment(float $amount): bool {
        return $this->adaptee->executePayment($amount);
    }

    public function getAdaptee(): CreditCardAdaptee {
        return $this->adaptee;
    }

    public function setAdaptee(CreditCardAdaptee $adaptee): void {
        $this->adaptee = $adaptee;
    }
}
