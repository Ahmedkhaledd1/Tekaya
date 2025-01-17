<?php
require_once 'AbstractIndividual.php';
require_once 'Model/IState.php';
require_once 'Model/DonationProxy.php';

class Admin extends AbstractIndividual
{

    private IState $iSatate;
    private String $role;

    public function __construct(string $email, string $password, string $mobile, string $firstName, string $lastName, string $SSN, bool $gender)
    {
        parent::__construct($email,  $password,  $mobile,  $firstName,  $lastName,  $SSN,  $gender);
        $this->iSatate=new DonationProxy();
        $this->role="Admin";
    }


    public function removeDonation(Donation $donation): bool
    {
        //$donation ->removeDonation();
        return true;
    }

    public function assignBenefeciary(Donation $donation, Benefeciary $benefeciary): bool
    {
        $donation ->setBenefeciary($benefeciary);
        $this->changeDonationState($donation,$this->role);
        return true;
    }
    public function assignVolunteer(Donation $donation, Volunteer $volunteer): bool
    {
    
        $donation ->setVolunteer($volunteer);
        $this->changeDonationState($donation,$this->role);
        return true;
    }
    public function generateReport($donorId):string
    {
        //to be implemented
        
    }

    public function changeDonationState(Donation $donation,$role):bool{

        $this->iSatate->changeState($donation,$role);

        return true;
    }
}
