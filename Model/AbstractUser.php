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


        $this->email = $email;
        $this->password = $password;
        $this->mobile = $mobile;
    }

    public function getUserByEmail(string $email)
    {
        $conn = DBConnection::getInstance()->getConnection();
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc(); // Fetch the associative array
            $this->password = $row["password"]; // Set the class property
            $this->mobile = $row["mobile"]; // Set the class property
            return true;
        } else {
            return false;
        }
    }
    public function setUserInfo(string $role)
    {
        $conn = DBConnection::getInstance()->getConnection();  // Get the actual database connection

        // Check if email already exists in the database
        $sql = "SELECT * FROM user WHERE email = '$this->email'";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            // Return error if email exists
            return 'Error: Duplicate entry for email';
        }

        // Insert user into the user table
        $sql = "INSERT INTO `user` (`email`, `password`, `mobile`, `role`) 
        VALUES ('$this->email', '$this->password', '$this->mobile', '$role')";

        if ($conn->query($sql)) {
            // Successfully inserted user, now get the user_id
            $user_id = $conn->insert_id;
            return $user_id;  // Return user_id to insert into individual table
        } else {
            return false;  // Failed to insert user info
        }
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
    public function getPassword(): string
    {
        return $this->password;
    }
    public function getId(): string
    {
        return $this->id;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    public function setAddress(string $address)
    {
        $this->address = $address;
    }
    public function setDonations($donations)
    {
        $this->donations = $donations;
    }
    public function setMobile(string $mobile)
    {
        $this->mobile = $mobile;
    }
    public function setPassword(string $password)
    {
        $this->password = $password;
    }
    public function setId(string $id)
    {
        $this->id = $id;
    }

    public static function getIdByEmail(string $email)
    {
        $conn = DBConnection::getInstance()->getConnection();
        $sql = "SELECT id FROM user WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            return $row['id'];
        } else {
            return null;
        }
    }

    public static function getRolebyEmail(string $email)
    {
        $conn = DBConnection::getInstance()->getConnection();
        $sql = "SELECT role FROM user WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['role'];
        } else {
            return 0;
        }
    }

    public static function getDonationsByEmail(string $email): array
    {
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
