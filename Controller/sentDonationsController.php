<?php
require_once 'View\sentDonationsView.php';
class SentDonationController {
    public function showSentDonations() {
       
    
        $user_id=$_SESSION['user_id'];
        $donations = Donation::getDonationsByDonorID($user_id);
        $view = new SentDonationsView();
        echo $view->renderDonationList($donations);
    }
}
