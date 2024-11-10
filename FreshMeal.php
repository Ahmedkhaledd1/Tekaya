<?php
class FreshMeal implements DonationStrategyInterface
{
    private DateTime $expirationDate;

    public function __construct(DateTime $expirationDate)
    {
        $this->expirationDate = $expirationDate;
    }

    public function deliverToBenefeciary(Donation $donation, Benefeciary $benefeciary): bool
    {
        $currentDate = new DateTime();
        if ($this->expirationDate > $currentDate) return false;
        return $benefeciary->confirmReceivedDonation($donation);
    }
}
