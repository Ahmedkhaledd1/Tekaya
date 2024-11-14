<?php
class DonationView {

    public function displayDonation($donation) {
        echo "<style>body { background-color: #eeeee4; font-family: Arial, sans-serif; }</style>"; 
        echo "<h2>Donation Details</h2>";
        echo "<p><strong>Donation ID:</strong> " . $donation->id . "</p>";
        echo "<p><strong>Amount:</strong> $" . $donation->amount . "</p>";
        echo "<p><strong>Donor Name:</strong> " . $donation->donorName . "</p>";
        echo "<p><strong>Beneficiary Name:</strong> " . $donation->beneficiaryName . "</p>";
        echo "<p><strong>Date:</strong> " . $donation->date . "</p>";
    }

    public function displayDonationList($donations) {
        echo "<style>body { background-color: #eeeee4; font-family: Arial, sans-serif; }</style>"; 
        echo "<h2>List of Donations</h2>";
        echo "<table border='1' style='width: 100%; border-collapse: collapse;'>";
        echo "<tr style='background-color: #f0f0f0;'><th>Donation ID</th><th>Amount</th><th>Donor Name</th><th>Beneficiary Name</th><th>Date</th></tr>";
        
        foreach ($donations as $donation) {
            echo "<tr>";
            echo "<td>" . $donation->id . "</td>";
            echo "<td>$" . $donation->amount . "</td>";
            echo "<td>" . $donation->donorName . "</td>";
            echo "<td>" . $donation->beneficiaryName . "</td>";
            echo "<td>" . $donation->date . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }

    public function displayDonationForm($donation) {
        echo "<style>body { background-color: #eeeee4; font-family: Arial, sans-serif; }</style>"; 
        echo "<h2>Donate Now</h2>";
        echo "<form method='post' action='process_donation.php' style='background-color: #fff; padding: 20px; border-radius: 5px; width: 300px; margin: auto;'>";
        echo "<label for='amount' style='display: block;'>Amount: </label><input type='number' name='amount' value='" . $donation->amount . "' required style='width: 100%; padding: 8px; margin: 5px 0; border-radius: 4px;'><br>";
        echo "<label for='donorName' style='display: block;'>Donor Name: </label><input type='text' name='donorName' value='" . $donation->donorName . "' required style='width: 100%; padding: 8px; margin: 5px 0; border-radius: 4px;'><br>";
        echo "<label for='beneficiaryName' style='display: block;'>Beneficiary Name: </label><input type='text' name='beneficiaryName' value='" . $donation->beneficiaryName . "' required style='width: 100%; padding: 8px; margin: 5px 0; border-radius: 4px;'><br>";
        echo "<label for='date' style='display: block;'>Date: </label><input type='date' name='date' value='" . $donation->date . "' required style='width: 100%; padding: 8px; margin: 5px 0; border-radius: 4px;'><br>";
        echo "<input type='submit' value='Submit Donation' style='background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;'>";
        echo "</form>";
    }

    public function displayDonationConfirmation($donation) {
        echo "<style>body { background-color: #eeeee4; font-family: Arial, sans-serif; }</style>"; 
        echo "<h2>Donation Confirmation</h2>";
        echo "<p>Thank you for your donation!</p>";
        echo "<p><strong>Donation ID:</strong> " . $donation->id . "</p>";
        echo "<p><strong>Amount:</strong> $" . $donation->amount . "</p>";
        echo "<p><strong>Donor Name:</strong> " . $donation->donorName . "</p>";
        echo "<p><strong>Beneficiary Name:</strong> " . $donation->beneficiaryName . "</p>";
        echo "<p><strong>Date:</strong> " . $donation->date . "</p>";
        echo "<p>Your donation has been successfully processed!</p>";
    }
}
?>
