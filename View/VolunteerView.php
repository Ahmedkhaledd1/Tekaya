<?php
class VolunteerView {

    public function displayVolunteerList($volunteers) {
        echo "<div style='background-color: #eeeee4; padding: 20px;'>";
        echo "<h2>List of Volunteers</h2>";
        echo "<table border='1' style='width: 100%;'>";
        echo "<tr><th>Volunteer ID</th><th>Name</th><th>Contact</th><th>Email</th></tr>";

        foreach ($volunteers as $volunteer) {
            echo "<tr>";
            echo "<td>" . $volunteer->id . "</td>";
            echo "<td>" . $volunteer->name . "</td>";
            echo "<td>" . $volunteer->contact . "</td>";
            echo "<td>" . $volunteer->email . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</div>";
    }

    public function displayVolunteerDetails($volunteer) {
        echo "<div style='background-color: #eeeee4; padding: 20px;'>";
        echo "<h2>Volunteer Details</h2>";
        echo "<p><strong>Volunteer ID:</strong> " . $volunteer->id . "</p>";
        echo "<p><strong>Name:</strong> " . $volunteer->name . "</p>";
        echo "<p><strong>Contact:</strong> " . $volunteer->contact . "</p>";
        echo "<p><strong>Email:</strong> " . $volunteer->email . "</p>";
        echo "<p><strong>Availability:</strong> " . $volunteer->availability . "</p>";
        echo "</div>";
    }

    public function showActivityHistory($activities) {
        echo "<div style='background-color: #eeeee4; padding: 20px;'>";
        echo "<h2>Activity History</h2>";
        echo "<table border='1' style='width: 100%;'>";
        echo "<tr><th>Activity ID</th><th>Activity Name</th><th>Date</th><th>Status</th></tr>";

        foreach ($activities as $activity) {
            echo "<tr>";
            echo "<td>" . $activity->id . "</td>";
            echo "<td>" . $activity->name . "</td>";
            echo "<td>" . $activity->date . "</td>";
            echo "<td>" . $activity->status . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</div>";
    }
}
?>
