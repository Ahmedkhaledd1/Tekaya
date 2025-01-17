<?php
require_once __DIR__ . '/../core/View.php';

class SentDonationsView extends View {
    public function renderDonationList($donations) {
        // Start rendering the page with a header
        $content = $this->renderNavbar($_SESSION['user_role']);
        $content .= "<div class='container'>";
        $content .= "<h2>List of Sent Donations</h2><ul>";

        foreach ($donations as $donation) {
            // Basic information about the donation
            $content .= "<li><strong>Title:</strong> {$donation['title']}<br>";
            $content .= "<strong>Type:</strong> {$donation['type']}<br>";

            // Render donation based on its type
            if ($donation['type'] === 'freshmeal') {
                $content .= $this->renderFreshMealDonation($donation);
            } else {
                $content .= $this->renderFoodSetDonation($donation);
            }

            // Common details for both types
            $content .= "<strong>Status:</strong> " . ($donation['confirmed'] ? 'Confirmed' : 'Not Confirmed') . "<br>";
            $content .= "<strong>Delivery Status:</strong> " . ($donation['delivered'] ? 'Delivered' : 'Not Delivered') . "<br>";
            $content .= "</li><hr>";
        }

        $content .= "</ul>";
        $content .= "</div>";

        // End rendering with a footer
        $content .= $this->renderFooter();
        return $content;
    }

    // Render for Fresh Meal donations
    private function renderFreshMealDonation($donation) {
        return "<strong>Expiry Date:</strong> {$donation['expiry_date']}<br>";
    }

    // Render for Food Set donations
    private function renderFoodSetDonation($donation) {
        return "<strong>Description:</strong> {$donation['description']}<br><strong>Cost:</strong> {$donation['cost']}<br>";
    }
}
