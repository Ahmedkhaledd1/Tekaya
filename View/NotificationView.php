<?php
class NotificationView {

    // Display a single notification
    public function displayNotification($notif) {
        echo "<div style='background-color: #eeeee4; padding: 20px;'>";
        echo "<h2>Notification</h2>";
        echo "<p><strong>Title:</strong> " . $notif->title . "</p>";
        echo "<p><strong>Message:</strong> " . $notif->message . "</p>";
        echo "<p><strong>Date:</strong> " . $notif->date . "</p>";
        echo "</div>";
    }

    // Show alerts or notifications with additional details
    public function showAlerts($details) {
        echo "<div style='background-color: #eeeee4; padding: 20px;'>";
        echo "<h2>Alerts</h2>";
        echo "<div style='border: 1px solid red; padding: 10px; background-color: #ffcccb;'>";
        echo "<strong>Alert:</strong> " . $details;
        echo "</div>";
        echo "</div>";
    }
}
?>
