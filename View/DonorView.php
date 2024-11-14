<?php
class DonorView {

    // Display a list of donors
    public function displayDonorList($donors) {
        echo "<div style='background-color: #eeeee4; padding: 20px;'>";
        echo "<h2>List of Donors</h2>";
        echo "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr style='background-color: #d0d0d0;'><th>Donor ID</th><th>Name</th><th>Contact</th><th>Email</th><th>Total Donations</th></tr>";

        foreach ($donors as $donor) {
            echo "<tr>";
            echo "<td>" . $donor->id . "</td>";
            echo "<td>" . $donor->name . "</td>";
            echo "<td>" . $donor->contact . "</td>";
            echo "<td>" . $donor->email . "</td>";
            echo "<td>$" . $donor->totalDonations . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</div>";
    }

    // Display details of a single donor
    public function displayDonorDetails($donor) {
        echo "<div style='background-color: #eeeee4; padding: 20px;'>";
        echo "<h2>Donor Details</h2>";
        echo "<p><strong>Donor ID:</strong> " . $donor->id . "</p>";
        echo "<p><strong>Name:</strong> " . $donor->name . "</p>";
        echo "<p><strong>Contact:</strong> " . $donor->contact . "</p>";
        echo "<p><strong>Email:</strong> " . $donor->email . "</p>";
        echo "<p><strong>Total Donations:</strong> $" . $donor->totalDonations . "</p>";
        echo "<p><strong>Donor Type:</strong> " . $donor->donorType . "</p>";
        echo "</div>";
    }
}
?>
