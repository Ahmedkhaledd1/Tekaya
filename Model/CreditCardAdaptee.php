<?php

class CreditCardAdaptee {
    private $cardNumber;
    private $cvv;

    public function __construct($cardNumber, $cvv) {
        $this->cardNumber = $cardNumber;
        $this->cvv = $cvv;
    }

    // Method to execute the payment logic
    public function executePayment(float $amount): bool {
        if ($amount > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getCardNumber() {
        return $this->cardNumber;
    }

    public function setCardNumber($cardNumber) {
        $this->cardNumber = $cardNumber;
    }


    public function getCvv() {
        return $this->cvv;
    }

    public function setCvv($cvv) {
        $this->cvv = $cvv;
    }
}
