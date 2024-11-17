<?php
require_once "DBConnection.php";
class Address
{
    private string $street;
    private string $city;
    private string $state;
    private string $zipcode;

    public function __construct(string $street, string $city, string $state, string $zipcode)
    {

        $this->street = $street;
        $this->city = $city;
        $this->state = $state;
        $this->zipcode = $zipcode;

    }
    public function setAddress(){
        $conn = DBConnection::getInstance()->getConnection();  // Get the actual database connection
        $sql = "INSERT INTO address (city, state, zipcode) VALUES ('$this->city', '$this->state', '$this->zipcode')"; 
        if ($conn->query($sql)) {
            return true;
        } else {
            return false;
        }


    }

    public function __toString(): string
    {
        return "$this->street, $this->city, $this->state, $this->zipcode";
    }
}
