<?php
class FoodSetView {

    // Display a single food item
    public function displayFoodSet($item) {
        echo "<div style='background-color: #eeeee4; padding: 20px;'>";
        echo "<h2>Food Item Details</h2>";
        echo "<p><strong>Name:</strong> " . $item->name . "</p>";
        echo "<p><strong>Description:</strong> " . $item->description . "</p>";
        echo "<p><strong>Quantity:</strong> " . $item->quantity . "</p>";
        echo "</div>";
    }

    // Display the list of food items
    public function displayFoodSetList($items) {
        echo "<div style='background-color: #eeeee4; padding: 20px;'>";
        echo "<h2>Food Set List</h2>";
        echo "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr style='background-color: #d0d0d0;'><th>Name</th><th>Quantity</th></tr>";
        
        foreach ($items as $item) {
            echo "<tr>";
            echo "<td>" . $item->name . "</td>";
            echo "<td>" . $item->quantity . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</div>";
    }
}
?>
