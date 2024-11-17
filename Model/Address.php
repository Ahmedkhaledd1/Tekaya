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
        $conn = DBConnection::getInstance()->getConnection();  // Get the actual database connection
        if (preg_match('/^[0-9]+$/', $zipcode)) {
            echo "valid";
        } else {
            echo "invalid";
            return;
        }
        $this->street = $street;
        $this->city = $city;
        $this->state = $state;
        $this->zipcode = $zipcode;

        $sql = "INSERT INTO address (city, state, zipcode) VALUES ('$city', '$state', '$zipcode')"; 
        $conn->query($sql);

    }

    public function __toString(): string
    {
        return "$this->street, $this->city, $this->state, $this->zipcode";
    }
}
