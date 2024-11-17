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

    public function setUserInfo(){

        $conn = DBConnection::getInstance()->getConnection();  // Get the actual database connection
        $sql = "INSERT INTO individual (ssn, user_id, first_name,last_name,gender) VALUES ('$this->SSN',NULL,'$this->firstName', '$this->lastName','$this->gender')";
    

        if ($conn->query($sql)) {
            return true;
        } else {
            return false;
        }

    }
}
