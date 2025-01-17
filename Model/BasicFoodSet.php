<?php
require_once 'FoodSet.php';
class BasicFoodSet extends FoodSet
{
    public function __construct(float $price)
    {
        $this->description = implode(", ", ["Rice", "Oil"]);
        $this->cost=$price;
        $this->Paid=false;

    }

    public function deliverToBenefeciary(Donation $donation, Benefeciary $benefeciary): bool
    {
        $currentDate = new DateTime();
        if ($this->expirationDate > $currentDate) return false;
        return $benefeciary->confirmReceivedDonation($donation);
    }
}
