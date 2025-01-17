<?php
require_once 'View/paymentView.php';
require_once 'Model\Donation.php';
require_once 'Model\Donor.php';
require_once 'Model\PaymentProcessor.php'; 
require_once 'Model\CreditCardAdapter.php';
require_once 'Model\PayPalAdapter.php';

class PaymentDonationController {

    public function processPayment() {
        $view = new PaymentView();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $paymentMethod = $_POST['payment_method']; // 'credit_card' or 'paypal'
            $amount = $_POST['amount'];

            try {
                // Prepare the payment processor based on selected payment method
                $paymentProcessor = null;

                if ($paymentMethod === 'credit_card') {
                    $cardholderName = $_POST['cardholder_name'];
                    $cardNumber = $_POST['card_number'];
                    $expiryDate = $_POST['expiry_date'];
                    $cvv = $_POST['cvv'];

                    // Here, you would pass necessary credit card details to the adapter
                    $creditCardAdaptee = new CreditCardAdaptee($cardholderName, $cardNumber, $expiryDate, $cvv);
                    $paymentProcessor = new CreditCardAdapter($creditCardAdaptee); 

                } elseif ($paymentMethod === 'paypal') {
                    $paypalEmail = $_POST['paypal_email'];
                    $paypalPassword = $_POST['paypal_password'];

                    // Create a PayPal Adapter
                    $payPalAdaptee = new PayPalAdaptee($paypalEmail, $paypalPassword);
                    $paymentProcessor = new PayPalAdapter($payPalAdaptee);  // Use PayPalAdapter
                }



            } catch (Exception $e) {
                echo $view->render("Error: " . $e->getMessage());  // Render error message if something goes wrong
            }
        } else {
            echo $view->render();  // Render payment form for user
        }
    }
}
