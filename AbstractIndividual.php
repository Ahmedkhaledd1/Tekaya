<?php
require_once 'AbstractUser.php';
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
}
