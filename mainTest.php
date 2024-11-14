<?php

require_once 'Model\Donor.php';
require_once 'Model\Volunteer.php';
require_once 'Model\Donation.php';
require_once 'Model\Benefeciary.php';
require_once 'Model\FreshMeal.php';
require_once 'Model\FoodSet.php';
require_once 'Model\Chicken.php';
require_once 'Model\Meat.php';
require_once 'Model\Rice.php';
require_once 'Model\FoodSetDecorator.php';
require_once 'Model\BasicFoodSet.php';

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

$foodset =new BasicFoodSet(100);

echo $foodset->getItems(). "<br>";
$foodset2 =new  Chicken($foodset,200);

echo $foodset2->getItems()." ". $foodset2->getCost();