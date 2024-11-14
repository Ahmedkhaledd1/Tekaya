<?php

require_once 'AbstractIndividual.php';
require_once 'SMSNotifier.php';
require_once 'EmailNotifier.php';
class Donor extends AbstractIndividual
{

    public function __construct(string $email, string $password, string $mobile, string $firstName, string $lastName, string $SSN, bool $gender)
    {
        parent::__construct($email,  $password,  $mobile,  $firstName,  $lastName,  $SSN,  $gender);
    }

    public function addDonation(Donation $donation)
    {
        $donation->setDonor($this);
        $donation->addObserver(new SMSNotifier($this));
        $donation->addObserver(new EmailNotifier($this));
    }
}
