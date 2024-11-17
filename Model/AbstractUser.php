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
    public function getMobile(): string
    {
        return $this->mobile;
    }

    public static function getIdByEmail(string $email){
        $conn = DBConnection::getInstance()->getConnection();
        $sql = "SELECT id FROM user WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['id'];
        } else {
            return 0;
        }
    }
    public static function getDonationsByEmail(string $email): array{
        $id = self::getIdByEmail($email);
        if ($id === 0) {
            return []; 
        }
        $conn = DBConnection::getInstance()->getConnection();
        $sql = "SELECT * FROM donation WHERE (donor_id = '$id' OR beneficiary_id = '$id')";
        $result = $conn->query($sql);

        $donations = [];
        while ($row = $result->fetch_assoc()) {
            $donation = new Donation($row['donation_id']);
            $donations[] = $donation;
        }
    
        return $donations;
    }

    public static function getMobileByEmail(string $email): ?string
{
    $conn = DBConnection::getInstance()->getConnection();
    $sql = "SELECT mobile FROM user WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['mobile'];
    } else {
        return null;
    }
}
}
