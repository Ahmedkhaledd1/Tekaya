<?php

require_once 'Donor.php';
require_once 'Volunteer.php';
require_once 'Donation.php';
require_once 'Benefeciary.php';
require_once 'FreshMeal.php';
$donor = new Donor("Alice the Donor", "password", "015", "alice", "donor", "aliceSSN", false);
$volunteer = new Volunteer("Bob the Volunteer", "password", "015", "alice", "volunteer", "aliceSSN", true);
$beneficiary = new Benefeciary("Charlie the Beneficiary", "password", "015", "alice", "benef", "aliceSSN", true);

$donation = new Donation("Donation1");
$currentDate = new DateTime();

$currentDate->add(new DateInterval('PT6H'));
$donation->setDonationStrategy(new FreshMeal($currentDate));
$donor->addDonation($donation);
$volunteer->deliverDonation($donation);
$beneficiary->confirmReceivedDonation($donation);
echo $donation;
