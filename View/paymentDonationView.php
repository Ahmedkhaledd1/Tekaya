<?php
require_once __DIR__ . '/../Core/View.php';

class PaymentView extends View {
    public function __construct() {
        // Set the title and add CSS for the page
        $this->setTitle("Payment Page");
        $this->addStyle("View/style.css"); // Correct path to style.css inside the View folder
    }

    public function render($message = '') {
        $content = $this->renderHeader();
        $content .= "
        <div class='container'>
        <form method='POST' action='/process-payment'>
            <h2>Payment</h2>";
        
        if (!empty($message)) {
            $content .= "<p style='color: green;'>{$message}</p>";
        }

        $content .= "
            <label>Select Payment Method:</label>
            <select name='payment_method' id='payment_method' onchange='togglePaymentFields()'>
                <option value=''>-- Select Payment Method --</option>
                <option value='credit_card'>Credit Card</option>
                <option value='paypal'>PayPal</option>
            </select>

            <div id='credit_card_fields' style='display:none;'>
                <h3>Credit Card Payment</h3>
                <input type='text' name='card_number' placeholder='Card Number' maxlength='16' required>
                <input type='text' name='cvv' placeholder='CVV' maxlength='3' required>
            </div>
            
            <div id='paypal_fields' style='display:none;'>
                <h3>PayPal Payment</h3>
                <input type='email' name='paypal_email' placeholder='PayPal Email' required>
                <input type='password' name='paypal_password' placeholder='PayPal Password' required>
            </div>
            
            <button type='submit'>Submit Payment</button>
        </form>
        </div>";

        $content .= "
        <script>
            function togglePaymentFields() {
                const paymentMethod = document.getElementById('payment_method').value;
                
                // Show Credit Card fields and hide PayPal fields
                if (paymentMethod === 'credit_card') {
                    document.getElementById('credit_card_fields').style.display = 'block';
                    document.getElementById('paypal_fields').style.display = 'none';
                }
                // Show PayPal fields and hide Credit Card fields
                else if (paymentMethod === 'paypal') {
                    document.getElementById('credit_card_fields').style.display = 'none';
                    document.getElementById('paypal_fields').style.display = 'block';
                }
                // If no payment method selected, hide both fields
                else {
                    document.getElementById('credit_card_fields').style.display = 'none';
                    document.getElementById('paypal_fields').style.display = 'none';
                }
            }
        </script>";

        $content .= $this->renderFooter();
        return $content;
    }
}
?>
