<?php
require_once 'SubjectInterface.php';
require_once "DBConnection.php";
require_once "FreshMeal.php";
require_once "FoodSet.php";
class Donation implements SubjectInterface

{   private int $donationId;
    private array $observers = [];
    private bool $delivered;
    private Benefeciary $benefeciary;
    private AbstractUser $donor;
    private DonationStrategyInterface $strategy;
    private Volunteer $volunteer;
    private iState $state;

    


    public function setDonor(Donor $donor)
    {
        $this->donor = $donor;
    }

    public function addObserver(ObserverInterface $ob)
    {
        array_push($this->observers, $ob);
    }

    public function getStrategy()
    {
        return $this->strategy;
    }
    
    public function getDonationId()
    {
        return $this->donationId;
    }



    public function removeObserver(ObserverInterface $ob)
    {
        array_pop($this->observers, $ob);
    }

    public function notifyObservers()
    {
        foreach ($this->observers as $ob) {
            $ob->update($this);
        }
    }

    public function removeStrategy(): bool
    {
        $this->strategy = null;
        return true;
    }


    public function setDonationStrategy(DonationStrategyInterface $strategy): bool
    {
        $this->strategy = $strategy;
        $conn = DBConnection::getInstance()->getConnection();  // Get the actual database connection
        if ($this->strategy instanceof FreshMeal) {
            $escaped_date = $conn->real_escape_string($this->strategy->__toString());
            $sql="INSERT INTO freshmeal (expiry_date) VALUES ('$escaped_date')";
            $freshmealId= -1;
            $donationId=-1;
            if(!$conn->query($sql))return false;
            $freshmealId = $conn->insert_id;
            $sql ="INSERT INTO donation () VALUES ()";
            if(!$conn->query($sql))return false;
            $donationId = $conn->insert_id;
            $sql ="INSERT INTO donationdetails (donation_id, foodtype, food_item_id) VALUES ($donationId, 0, $freshmealId)";
            if(!$conn->query($sql))return false;
            return true;
        }
        if ($this->strategy instanceof FoodSet) {
            $escaped_description = $conn->real_escape_string($this->strategy->getItems());
            $escaped_cost = $conn->real_escape_string($this->strategy->getCost());
            
            $sql = "INSERT INTO foodset (description, cost) VALUES ('$escaped_description', '$escaped_cost')";
            $foodsetId= -1;
            $donationId=-1;
            if(!$conn->query($sql))return false;
            $foodsetId = $conn->insert_id;
            $sql ="INSERT INTO donation () VALUES ()";
            if(!$conn->query($sql))return false;
            $donationId = $conn->insert_id;
            $sql ="INSERT INTO donationdetails (donation_id, foodtype, food_item_id) VALUES ($donationId, 1, $foodsetId)";
            if(!$conn->query($sql))return false;
            return true;
        }
        return false;
    }


    
    public function getDBDonations() {
        $conn = DBConnection::getInstance()->getConnection();
        $sql = "SELECT * FROM donation";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }
    }


}
