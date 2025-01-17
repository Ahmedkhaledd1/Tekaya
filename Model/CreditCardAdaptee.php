<?php

class CreditCardAdaptee {
    public function executePayment(float $amount): bool {
        if ($amount > 0) {
            return true;
        } else {
            return false;
        }
    }
}
