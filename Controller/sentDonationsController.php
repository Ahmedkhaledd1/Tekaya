<?php
require_once 'View\sentDonationsView.php';
class SentDonationController {
    public function showSentDonations() {
       
    
        // Sample data, typically fetched from the database
        $donations = [
            [
                'title' => 'Fresh Meal for Shelter',
                'type' => 'freshmeal',
                'expiry_date' => '2024-12-01',
                'confirmed' => true,
                'delivered' => false
            ],
            [
                'title' => 'Food Set for Families',
                'type' => 'foodset',
                'description' => 'Rice, beans, and vegetables',
                'cost' => '$50',
                'confirmed' => true,
                'delivered' => true
            ]
        ];

        $view = new SentDonationsView();
        echo $view->renderDonationList($donations);
    }
}
