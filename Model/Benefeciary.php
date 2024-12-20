<?php
require_once 'AbstractIndividual.php';
class Benefeciary extends AbstractIndividual
{

    public function __construct(string $email, string $password, string $mobile, string $firstName, string $lastName, string $SSN, bool $gender)
    {
        parent::__construct($email,  $password,  $mobile,  $firstName,  $lastName,  $SSN,  $gender);
    }
    public function confirmReceivedDonation(Donation $donation): bool
    {
        # check for benefeciary confirmation
        $donation->setConfirmReceived($this);
        return true;
    }
}
