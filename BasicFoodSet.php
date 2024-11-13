<?php
require_once 'FoodSet.php';
class BasicFoodSet extends FoodSet
{
    public function __construct()
    {
        $this->basicFoodSet = ["Rice", "Sugar", "Oil", "Vegtables"];
        $this->cost = count($this->basicFoodSet) * 10;
    }

    public function getItems(): string
    {
        return implode(",", $this->basicFoodSet);
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
