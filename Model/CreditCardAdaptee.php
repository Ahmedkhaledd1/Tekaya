<?php

class CreditCardAdaptee {
    private $cardholderName;
    private $cardNumber;
    private $expiryDate;
    private $cvv;

    public function __construct($cardholderName, $cardNumber, $expiryDate, $cvv) {
        $this->cardholderName = $cardholderName;
        $this->cardNumber = $cardNumber;
        $this->expiryDate = $expiryDate;
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

    public function getCardholderName() {
        return $this->cardholderName;
    }

    public function setCardholderName($cardholderName) {
        $this->cardholderName = $cardholderName;
    }

    public function getCardNumber() {
        return $this->cardNumber;
    }

    public function setCardNumber($cardNumber) {
        $this->cardNumber = $cardNumber;
    }

    public function getExpiryDate() {
        return $this->expiryDate;
    }

    public function setExpiryDate($expiryDate) {
        $this->expiryDate = $expiryDate;
    }

    public function getCvv() {
        return $this->cvv;
    }

    public function setCvv($cvv) {
        $this->cvv = $cvv;
    }
}
