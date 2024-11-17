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

    public function setIndividualInfo() {
        // First, insert user and get the user_id
        $user_id = parent::setUserInfo();
        
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
    
    
}
