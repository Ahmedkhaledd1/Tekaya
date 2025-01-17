<?php
require_once 'AbstractIndividual.php';
require_once 'Model/IState.php';
require_once 'Model/DonationProxy.php';


class Benefeciary extends AbstractIndividual
{

    private IState $iSatate;
    private String $role;


    public function __construct(string $email, string $password, string $mobile, string $firstName, string $lastName, string $SSN, bool $gender)
    {
        parent::__construct($email,  $password,  $mobile,  $firstName,  $lastName,  $SSN,  $gender);
        $this->iSatate=new DonationProxy();
        $this->role="Benefeciary";
    }
    public function confirmReceivedDonation(Donation $donation): bool
    {
        $this->iSatate->changeState($donation,$this->role);
    
        return true;
    }
}
