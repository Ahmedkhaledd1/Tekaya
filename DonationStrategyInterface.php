<?php
interface DonationStrategyInterface
{
    public function deliverToBenefeciary(Donation $donation, Benefeciary $benefeciary): bool;
}
