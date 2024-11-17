<?php
require_once 'SubjectInterface.php';
require_once "DBConnection.php";
require_once "FreshMeal.php";
require_once "FoodSet.php";
class Donation implements SubjectInterface
{
    private int $donationId;
    private Benefeciary $benefeciary;
    private AbstractUser $donor;
    private DonationStrategyInterface $strategy;
    private bool $confirmReceived;
    private array $observers = [];

    // public function __construct()
    // {
    //     $conn = DBConnection::getInstance()->getConnection();  // Get the actual database connection
    //     $this-> donationId= $id;
    //     $sql = "INSERT INTO address (donation_id) VALUE ('$id')"; 
    //     $conn->query($sql);
    // }

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

    public function removeStrategy(): bool
    {
        $this->strategy = null;
        return true;
    }

    public function hasStrategy()
    {
        return $this->strategy;
    }

    public function excuteDonation(Benefeciary $benefeciary, FoodSet $foodset): bool
    {
        $this->strategy->deliverToBenefeciary($this, $benefeciary);
        if ($this->confirmReceived) {
            #notify observers that donation delivered successfully
            $conn = DBConnection::getInstance()->getConnection();
            if ($foodset != Null) {
                $sql = "INSERT INTO address (description, cost) VALUES ('" . $foodset->getItems() . "', '" . $foodset->getCost() . "')";
                $conn->query($sql);
            }

            return true;
        }

        return false;
    }



    public function setConfirmReceived(Benefeciary $benefeciary)
    {
        $this->benefeciary = $benefeciary;
        $this->confirmReceived = true;
    }

    public function setDonor(Donor $donor)
    {
        $this->donor = $donor;
    }

    public function addObserver(ObserverInterface $ob)
    {
        array_push($this->observers, $ob);
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
    public function getDBDonations() {
        $conn = DBConnection::getInstance()->getConnection();
        $sql = "SELECT * FROM donation";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }
    }

    /* public function __toString()
    {
    
        if ($this->donor) {
            return "Donation Id: ". $this->donationId ."\n email:" . $this->donor->getEmail() . "\nbenefec: " . $this->benefeciary->getEmail() . "\n strat: " . $this->strategy;
        } else {
            return "Donation Id: ". $this->donationId . "\n Donor not set";
        }
    
    }*/
    public function getDonationId()
    {
        return $this->donationId;
    }
}
