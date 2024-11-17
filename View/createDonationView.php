<?php
require_once __DIR__ . '/../Core/View.php';

class CreateDonationView extends View
{
    public function render($title, $type, $description, $cost, $addons, $expiryDate, $selectedAddons)
    {
        $this->addStyle('/css/style.css');
        echo $this->renderHeader();

        echo "
        <div class='container'>
            <h1>Create Donation</h1>
            <form method='POST' action=''>
                <label for='title'>Title:</label>
                <input type='text' id='title' name='title' value='{$title}' required placeholder='Enter donation title'>
                
                <label for='type'>Type:</label>
                <select name='type' id='type' onchange='this.form.submit()'>
                    <option value='freshmeal' " . ($type === 'freshmeal' ? 'selected' : '') . ">Fresh Meal</option>
                    <option value='foodset' " . ($type === 'foodset' ? 'selected' : '') . ">Food Set</option>
                </select>
            </form>";

        // Show Fresh Meal form
        if ($type === 'freshmeal') {
            echo "
            <form method='POST' action='/create-donation/confirm' style='display:inline'>
                <input type='hidden' name='type' value='freshmeal'>
                <label for='expiry_date'>Expiry Date:</label>
                <input type='date' name='expiry_date' value='{$expiryDate}'>
                <button type='submit'>Create Donation</button>
            </form>";
        } elseif ($type === 'foodset') {
            echo "
            <form method='POST' action=''>
                <input type='hidden' name='type' value='foodset'>
                <p id='description'>Description: {$description}</p>
                <p id='cost'>Cost: \${$cost}</p>

                <label for='addon'>Add Add-on:</label>
                <select name='addon' id='addon'>
                    <option value='' disabled selected>Select an add-on</option>";

            foreach ($addons as $index => $addon) {
                echo "<option value='{$index}'>{$addon['name']} (+\${$addon['cost']})</option>";
            }

            echo "
                </select>
                <button type='submit'>Add Add-on</button>
            </form>";

            // Display selected add-ons with option to remove them
            if (!empty($selectedAddons)) {
                echo "<h3>Selected Add-ons</h3><ul>";
                foreach ($selectedAddons as $index => $addon) {
                    echo "<li>{$addon['name']} (+\${$addon['cost']}) 
                    <form method='POST' action='' style='display:inline'>
                        <input type='hidden' name='remove_addon' value='{$index}'>
                        <button type='submit'>Remove</button>
                    </form>
                    </li>";
                }
                echo "</ul>";
            }

            echo "
                <form method='POST' action='/create-donation/confirm' style='display:inline'>
                    <button type='submit'>Confirm Donation</button>
                </form>
            </form>";
        }

        echo "
        </div>";
        echo $this->renderFooter();
    }
}
