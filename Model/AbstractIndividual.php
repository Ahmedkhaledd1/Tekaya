<?php
require_once 'AbstractUser.php';
require_once "DBConnection.php";
abstract class AbstractIndividual extends AbstractUser
{
    protected string $firstName;
    protected string $lastName;
    protected string $SSN;
    protected bool $gender;

    public function __construct(string $email, string $password, string $mobile, string $firstName, string $lastName, string $SSN, bool $gender)
    {

        parent::__construct($email, $password, $mobile);
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->SSN = $SSN;
        $this->gender = $gender;
    }
    public function getFirstName()
    {
        return $this->firstName;
    }
    public function getLastName()
    {
        return $this->lastName;
    }
    public function getSSN()
    {
        return $this->SSN;
    }
    public function getGender()
    {
        return $this->gender;
    }
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }
    public function setSSN(string $SSN)
    {
        $this->SSN = $SSN;
    }
    public function setGender(bool $gender)
    {
        $this->gender = $gender;
    }

    public function setIndividualInfo(string $role)
    {
        // First, insert user and get the user_id
        $user_id = parent::setUserInfo($role);

        if ($user_id === false) {
            // If user insertion failed, return an error
            return false;
        }

        // Now insert individual information into the individual table using the obtained user_id
        $conn = DBConnection::getInstance()->getConnection();  // Get the actual database connection
        $sql = "INSERT INTO individual (ssn, user_id, first_name, last_name, gender) 
                VALUES ('$this->SSN', '$user_id', '$this->firstName', '$this->lastName', '$this->gender')";

        if ($conn->query($sql)) {
            return true;  // Successfully inserted individual info
        } else {
            return false;  // Failed to insert individual info
        }
    }
    public function getUserbyId(int $id)
    {
        // Check if email already exists in the database
        $conn = DBConnection::getInstance()->getConnection();
        $sql = "SELECT * FROM user WHERE id = '$id'";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            parent::__construct($row['email'], $row['password'], $row['mobile']);
        } else {
            return false;
        }
    }

    public function getInvidualByID(int $id)
    {
        $conn = DBConnection::getInstance()->getConnection();
        $sql = "SELECT * FROM individual WHERE user_id = '$id'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc(); // Fetch the associative array
            $this->firstName = $row["first_name"]; // Set the class property
            $this->lastName = $row["last_name"]; // Set the class property
            $this->gender = $row["gender"]; // Set the class property
            $this->SSN = $row["ssn"];
            return true;
        } else {
            return false;
        }
    }
}
