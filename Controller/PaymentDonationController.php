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
            $user=unserialize($_SESSION['user']);
            $amount = $_POST['amount'];


            try {

                $foodSet = null; //to be get from database later

                if ($paymentMethod === 'CreditCard') {
                    $cardNumber = $_POST['card_number'];
                    $cvv = $_POST['cvv'];

                    $user -> completePayment($paymentMethod,null,null,$cardNumber,$cvv,$foodSet);

                } elseif ($paymentMethod === 'Paypal') {
                    $paypalEmail = $_POST['paypal_email'];
                    $paypalPassword = $_POST['paypal_password'];


                    $user -> completePayment($paymentMethod,$paypalEmail,$paypalPassword,null,null,$foodSet);
                }

                



            } catch (Exception $e) {
                echo $view->render("Error: " . $e->getMessage());  // Render error message if something goes wrong
            }
        } else {
            echo $view->render();  // Render payment form for user
        }
    }
}
