<?php
require_once 'FoodSet.php';
class BasicFoodSet extends FoodSet
{
    public function __construct(float $price)
    {
        $this->description = implode(", ", ["Rice", "Oil"]);
        $this->cost=$price;

    }

    public function getItems(): string
    {
        return $this->description;
    }

    public function getCost(): int
    {

        return $this->cost;
    }
    public function deliverToBenefeciary(Donation $donation, Benefeciary $benefeciary): bool
    {
        $currentDate = new DateTime();
        if ($this->expirationDate > $currentDate) return false;
        return $benefeciary->confirmReceivedDonation($donation);
    }
}
