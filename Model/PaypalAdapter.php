<?php


require_once 'IPaymentProcessor.php';
require_once 'PaypalAdaptee.php';

class PaypalAdapter implements IPaymentProcessor {
    private $adaptee;

    public function __construct(PaypalAdaptee $adaptee) {
        $this->adaptee = $adaptee;
    }

    public function makePayment(float $amount): bool {
        return $this->adaptee->executePayment($amount);
    }

    public function getAdaptee(): PaypalAdaptee {
        return $this->adaptee;
    }

    public function setAdaptee(PaypalAdaptee $adaptee): void {
        $this->adaptee = $adaptee;
    }
}
