<?php
require_once 'DonationStrategyInterface.php';

class FreshMeal implements DonationStrategyInterface
{
    private DateTime $expirationDate;

    public function __construct(DateTime $expirationDate)
    {
        $this->expirationDate = $expirationDate;
        
    
    }


    public function setFreshMealInfo(){
        $conn = DBConnection::getInstance()->getConnection();  // Get the actual database connection
    
        $sql = "INSERT INTO address (fresh_meal_id) VALUE ('$this->expirationDate')"; 
        if( $conn->query($sql)){
            return true;

        }else{
            return false;
        }
    }

    public function deliverToBenefeciary(Donation $donation, Benefeciary $benefeciary): bool
    {
        $currentDate = new DateTime();
        if ($this->expirationDate > $currentDate) return false;
        return $benefeciary->confirmReceivedDonation($donation);
    }
    public function __toString()
    {
        return " " .$this->expirationDate->format("Y-m-d H:i:s");
    }
    
}
