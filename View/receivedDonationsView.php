<?php
require_once __DIR__ . '/../core/View.php';

class ReceivedDonationsView extends View {
    public function renderDonationList($donations) {
        $content = $this->renderNavbar($_SESSION['user_role']);
        $content .= "<div class='container'>";
        $content .= "<h2>List of Received Donations</h2><ul>";

        foreach ($donations as $donation) {
            $content .= $this->renderDonationItem($donation);
        }

        $content .= "</ul></div>";
        $content .= $this->renderFooter();
        return $content;
    }

    private function renderDonationItem($donation) {
        $content = "<li><strong>Title:</strong> {$donation['title']}<br>";
        $content .= "<strong>Type:</strong> {$donation['type']}<br>";

        if ($donation['type'] === 'freshmeal') {
            $content .= "<strong>Expiry Date:</strong> {$donation['expiry_date']}<br>";
        } else {
            $content .= "<strong>Description:</strong> {$donation['description']}<br>";
            $content .= "<strong>Cost:</strong> {$donation['cost']}<br>";
        }

        $content .= "<strong>Status:</strong> ";
        if ($donation['confirmed']) {
            $content .= "Confirmed<br>";
        } else {
            $content .= "Not Confirmed<br>";
            $content .= "
                <form method='POST' action='/receivedDonations'>
                    <input type='hidden' name='donation_id' value='{$donation['id']}'>
                    <button class='button' type='submit'>Confirm</button>
                </form>
            ";
        }

        $content .= "<strong>Delivery Status:</strong> " . ($donation['delivered'] ? 'Delivered' : 'Not Delivered') . "<br>";
        $content .= "</li><hr>";
        return $content;
    }
}
