<?php
require_once 'DonationStrategyInterface.php';
abstract class FoodSet implements DonationStrategyInterface{
    protected DateTime $expirationDate;
    protected array $basicFoodSet=[];
    protected string $description; 
    protected float $cost;
    abstract public function getItems():string;

    public function deliverToBenefeciary(Donation $donation, Benefeciary $benefeciary): bool
    {
        $currentDate = new DateTime();
        if ($this->expirationDate > $currentDate) return false;
        return $benefeciary->confirmReceivedDonation($donation);
    }
    public abstract function getCost():int;

}




