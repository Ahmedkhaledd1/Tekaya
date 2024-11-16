<?php
require_once "DBConnection.php";


abstract class AbstractUser
{
    protected string $id;
    protected string $email;
    protected string $password;
    protected Address $address;
    protected array $donations = [];
    protected string $mobile;

    public function __construct(string $email, string $password, string $mobile)
    {
        $conn = DBConnection::getInstance();
        
        $this->email = $email;
        $this->password = $password;
        $this->mobile = $mobile;

        $conn = DBConnection::getInstance()->getConnection();  // Get the actual database connection

        $this->email = $email;
        $this->password = $password;
        $this->mobile = $mobile;
    
        $sql = "INSERT INTO user (email, password, mobile) VALUES ('$email', '$password', '$mobile')";
    
        $conn->query($sql);

    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getAddress()
    {
        return $this->address;
    }
    public function getDonations()
    {
        return $this->donations;
    }
    public function getMobile()
    {
        return $this->mobile;
    }
}
