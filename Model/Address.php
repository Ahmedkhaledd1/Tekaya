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
    public function setAddress()
    {
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

    public function setStreet(string $street)
    {
        $this->street = $street;
    }

    public function setCity(string $city)
    {
        $this->city = $city;
    }

    public function setZipcode(string $zipcode)
    {
        $this->zipcode = $zipcode;
    }

    public function setState(string $state)
    {
        $this->state = $state;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getZipcode()
    {
        return $this->zipcode;
    }
}
