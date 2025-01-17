<?php
require_once 'DonationStrategyInterface.php';
abstract class FoodSet implements DonationStrategyInterface{
    protected DateTime $expirationDate;
    protected array $basicFoodSet=[];
    protected string $description; 
    protected float $cost;
    protected bool $paid;



    public function deliverToBenefeciary(Donation $donation, Benefeciary $benefeciary): bool
    {
        $currentDate = new DateTime();
        if ($this->expirationDate > $currentDate) return false;
        return $benefeciary->confirmReceivedDonation($donation);
    }
    

    public function isPaid():bool{
        return $this->paid;
    }

    public function setPaid(bool $paid){
        $this->paid=$paid;
    }

    
    public function getItems(): string
    {
        return $this->description;
    }

    public function getCost(): int
    {

        return $this->cost;
    }

}




