<?php
abstract class AbstractIndividual extends AbstractUser
{
    private string $firstName;
    private string $lastName;
    private string $SSN;
    private bool $gender;

    public function __construct(string $email, string $password, string $mobile, string $firstName, string $lastName, string $SSN, bool $gender)
    {
        parent::__construct($email, $password, $mobile);
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->SSN = $SSN;
        $this->gender = $gender;
    }
}
