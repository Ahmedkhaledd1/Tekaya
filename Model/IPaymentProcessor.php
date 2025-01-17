<?php

interface IPaymentProcessor {
    public function makePayment(float $amount): bool;
}
