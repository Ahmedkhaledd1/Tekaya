<?php
class OrganizationView {

    // Display a list of organizations
    public function displayOrganizationList($organizations) {
        echo "<div style='background-color: #eeeee4; padding: 20px;'>";
        echo "<h2>List of Organizations</h2>";
        echo "<table border='1' style='width: 100%;'>";
        echo "<tr><th>Organization ID</th><th>Name</th><th>Location</th><th>Contact</th></tr>";
        
        foreach ($organizations as $organization) {
            echo "<tr>";
            echo "<td>" . $organization->id . "</td>";
            echo "<td>" . $organization->name . "</td>";
            echo "<td>" . $organization->location . "</td>";
            echo "<td>" . $organization->contact . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</div>";
    }

    // Display details of a single organization
    public function displayOrganizationDetails($organization) {
        echo "<div style='background-color: #eeeee4; padding: 20px;'>";
        echo "<h2>Organization Details</h2>";
        echo "<p><strong>Organization ID:</strong> " . $organization->id . "</p>";
        echo "<p><strong>Name:</strong> " . $organization->name . "</p>";
        echo "<p><strong>Location:</strong> " . $organization->location . "</p>";
        echo "<p><strong>Contact:</strong> " . $organization->contact . "</p>";
        echo "<p><strong>Description:</strong> " . $organization->description . "</p>";
        echo "</div>";
    }
}
?>
