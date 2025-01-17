<?php
require_once 'AbstractIndividual.php';
class Admin extends AbstractIndividual
{

    public function __construct(string $email, string $password, string $mobile, string $firstName, string $lastName, string $SSN, bool $gender)
    {
        parent::__construct($email,  $password,  $mobile,  $firstName,  $lastName,  $SSN,  $gender);
    }

        public function changeDonationState(Donation $donation): bool
    {
        //to be implemented
        return true;
    }
    public function removeDonation(Donation $donation): bool
    {
        //$donation ->removeDonation();
        return true;
    }

    public function assignBeneficiary(Donation $donation, Benefeciary $benefeciary): bool
    {
        $donation ->setBenefeciary($benefeciary);
        return true;
    }
    public function assignVolunteer(Donation $donation, Volunteer $volunteer): bool
    {
        $donation ->setVolunteer($volunteer);
        return true;
    }
    public function generateReport($donorId):string
    {
        //to be implemented
        
    }
}
