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
        $conn = DBConnection::getInstance()->getConnection();
        parent::__construct($email, $password, $mobile);
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->SSN = $SSN;
        $this->gender = $gender;
        
        $sql = "INSERT INTO individual (ssn, user_id, first_name,last_name,gender) VALUES ('$SSN',NULL,'$firstName', '$lastName','$gender')";
        
        $conn->query($sql);

    }
}
