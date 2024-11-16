<?php
require_once 'View\createDonationView.php';
class createDonationController {

    public function createDonation() {
        // Instantiate the donation view and render it
        $view = new createDonationView();
        echo $view->render();  // Display the donation form
    }

}
