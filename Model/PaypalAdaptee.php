<?php

class PaypalAdaptee {
    public function executePayment(float $amount): bool {
        if ($amount > 0) {
            return true;
        } else {
            return false;
        }
    }
}
