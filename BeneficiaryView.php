<?php
class BeneficiaryView {

    public function displayBeneficiaryList($beneficiaries) {
        echo "<style>body { background-color: #eeeee4; }</style>"; 
        echo "<h2>List of Beneficiaries</h2>";
        echo "<table border='1' style='width: 100%; border-collapse: collapse;'>";
        echo "<tr style='background-color: #f0f0f0;'><th>Beneficiary ID</th><th>Name</th><th>Location</th><th>Contact</th></tr>";
        
        foreach ($beneficiaries as $beneficiary) {
            echo "<tr>";
            echo "<td>" . $beneficiary->id . "</td>";
            echo "<td>" . $beneficiary->name . "</td>";
            echo "<td>" . $beneficiary->location . "</td>";
            echo "<td>" . $beneficiary->contact . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }

    // Display details of a single beneficiary
    public function displayBeneficiaryDetails($beneficiary) {
        echo "<style>body { background-color: #eeeee4; }</style>";
        echo "<h2>Beneficiary Details</h2>";
        echo "<p><strong>Beneficiary ID:</strong> " . $beneficiary->id . "</p>";
        echo "<p><strong>Name:</strong> " . $beneficiary->name . "</p>";
        echo "<p><strong>Location:</strong> " . $beneficiary->location . "</p>";
        echo "<p><strong>Contact:</strong> " . $beneficiary->contact . "</p>";
        echo "<p><strong>Needs:</strong> " . $beneficiary->needs . "</p>";
        echo "<p><strong>Description:</strong> " . $beneficiary->description . "</p>";
    }
}
?>
