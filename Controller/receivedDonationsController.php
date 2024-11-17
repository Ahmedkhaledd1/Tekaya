<?php
require_once 'View\receivedDonationsView.php';

class ReceivedDonationsController {
    public function __construct() {
        session_start();

        // Initialize donations in the session if not already set
        if (!isset($_SESSION['donations'])) {
            $_SESSION['donations'] = [
                ['id' => 1, 'title' => 'Fresh Meal', 'type' => 'freshmeal', 'expiry_date' => '2024-11-20', 'confirmed' => false, 'delivered' => false],
                ['id' => 2, 'title' => 'Food Set', 'type' => 'foodset', 'description' => 'A package of essential food items', 'cost' => 100, 'confirmed' => true, 'delivered' => false],
                ['id' => 3, 'title' => 'Food Set', 'type' => 'foodset', 'description' => 'A package of essential food', 'cost' => 107, 'confirmed' => false, 'delivered' => false],
            ];
        }
    }

    public function showReceivedDonations() {
        // If a confirmation request is made
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['donation_id'])) {
            $donationId = (int)$_POST['donation_id'];
            $this->confirmDonation($donationId);
        }

        // Render the view with updated donations
        $view = new ReceivedDonationsView();
        echo $view->renderDonationList($_SESSION['donations']);
    }

    private function confirmDonation($donationId) {
        foreach ($_SESSION['donations'] as &$donation) {
            if ($donation['id'] === $donationId) {
                $donation['confirmed'] = true; // Update confirmation status
                break;
            }
        }
    }
}
