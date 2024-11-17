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
require_once "Model\DBConnection.php";



$donor = new Donor("Alice the Donor", "password", "015", "alice", "donor", "a", false);
$volunteer = new Volunteer("Bob the Volunteer", "johfsd", "010", "Bob", "volunteer", "b", true);
$beneficiary = new Benefeciary("Charlie the Beneficiary", "ugsfigf", "011", "CHARLIE", "benef", "c", true);


$donation = new Donation(1);
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

echo $donor->getEmail();

echo AbstractUser::getMobileByEmail('johndoe@example.com');
echo '<br>';
$donations = AbstractUser::getDonationsByEmail('johndoe@example.com');

foreach ($donations as $donation) {
    echo $donation->getDonationId() . '<br>';
}


