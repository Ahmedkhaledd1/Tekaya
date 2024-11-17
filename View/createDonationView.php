<?php
class CreateDonationView extends View {

    // Render method to display the donation form
    public function render($foodSet = null, $addons = [], $cost = 0) {
        $content = $this->renderHeader();
        $content .= "
        <h2>Create Donation</h2>
        <form method='POST' action='/create-donation'>
            <label for='donation_type'>Donation Type</label>
            <select name='donation_type' id='donation_type'>
                <option value='fresh_meal'>Fresh Meal</option>
                <option value='food_set'>Food Set</option>
            </select>
            
            <div id='meal_details' style='display: none;'>
                <label for='expiry_date'>Expiry Date</label>
                <input type='date' name='expiry_date' id='expiry_date'>
            </div>
            
            <div id='food_set_details' style='display: none;'>
                <h3>Food Set Description</h3>
                <p>" . ($foodSet ? $foodSet['description'] : 'No description available') . "</p>
                
                <label for='addons'>Add-ons</label>
                <div id='addons'>
                    ";

        // Display the add-ons with quantity inputs and their cost
        foreach ($addons as $addon) {
            $content .= "
            <div class='addon'>
                <label>" . ucfirst($addon['type']) . " (Cost: {$addon['cost']})</label>
                <input type='number' name='addon_{$addon['type']}_quantity' 
                       value='{$addon['quantity']}' min='1' step='1' class='addon-quantity'>
                <span class='addon-cost'>Cost: " . $addon['cost'] * $addon['quantity'] . "</span>
            </div>
            ";
        }

        $content .= "
                </div>

                <h4>Total Cost: <span id='total_cost'>$ {$cost}</span></h4>
            </div>

            <button type='submit'>Submit Donation</button>
        </form>
        
        <script>
            // Update the total cost based on addon quantities
            function updateTotalCost() {
                let totalCost = 0;
                const addonQuantities = document.querySelectorAll('.addon-quantity');
                addonQuantities.forEach(function(input) {
                    const addonCost = parseFloat(input.dataset.cost);
                    const quantity = parseInt(input.value);
                    totalCost += addonCost * quantity;
                    const costElement = input.closest('.addon').querySelector('.addon-cost');
                    costElement.textContent = 'Cost: ' + (addonCost * quantity);
                });
                document.getElementById('total_cost').textContent = '$ ' + totalCost.toFixed(2);
            }

            // Set the initial costs based on current quantity values
            document.querySelectorAll('.addon-quantity').forEach(function(input) {
                input.dataset.cost = input.closest('.addon').querySelector('label').textContent.match(/\d+(\.\d{1,2})?/)[0];
                input.addEventListener('input', updateTotalCost);
            });

            // Call updateTotalCost initially to calculate the cost when page loads
            updateTotalCost();

            document.getElementById('donation_type').addEventListener('change', function() {
                var donationType = this.value;
                if (donationType === 'fresh_meal') {
                    document.getElementById('meal_details').style.display = 'block';
                    document.getElementById('food_set_details').style.display = 'none';
                } else if (donationType === 'food_set') {
                    document.getElementById('food_set_details').style.display = 'block';
                    document.getElementById('meal_details').style.display = 'none';
                }
            });
        </script>
        ";

        $content .= $this->renderFooter();
        return $content;
    }
}
