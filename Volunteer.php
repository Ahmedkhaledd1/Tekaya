<?php
require_once 'AbstractIndividual.php';
class Volunteer extends AbstractIndividual
{

    public function __construct(string $email, string $password, string $mobile, string $firstName, string $lastName, string $SSN, bool $gender)
    {
        parent::__construct($email,  $password,  $mobile,  $firstName,  $lastName,  $SSN,  $gender);
    }
    public function removeDonation() {}
    public function deliverDonation() {}
}
