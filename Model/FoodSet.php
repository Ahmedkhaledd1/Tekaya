<?php
require_once 'DonationStrategyInterface.php';
abstract class FoodSet implements DonationStrategyInterface{
    protected DateTime $expirationDate;
    protected array $basicFoodSet=[];
    protected string $description; 
    protected float $cost;
    protected bool $Paid;



    public function deliverToBenefeciary(Donation $donation, Benefeciary $benefeciary): bool
    {
        $currentDate = new DateTime();
        if ($this->expirationDate > $currentDate) return false;
        return $benefeciary->confirmReceivedDonation($donation);
    }
    

    public function isPaid():bool{
        return $this->Paid;
    }

    public function setPaid(float $cost){
        $this->Paid=$cost;
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




