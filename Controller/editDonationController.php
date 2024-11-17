<?php
require_once 'View/editDonationView.php';

class EditDonationController {
    private $addons = [
        ['name' => 'Rice', 'cost' => 5],
        ['name' => 'Beans', 'cost' => 3],
        ['name' => 'Oil', 'cost' => 7]
    ];

    private $baseFoodSet = [
        'description' => 'Basic food set: Bread and water',
        'cost' => 10
    ];

    public function __construct() {
        session_start();
        // Initialize session values if not set
        if (!isset($_SESSION['donation'])) {
            $_SESSION['donation'] = [
                'title' => '',
                'type' => 'freshmeal', // default type
                'expiry_date' => '',
                'addons' => []
            ];
        }
    }

    public function showEditDonation() {
        // Fetch current data from session
        $title = isset($_SESSION['donation']['title']) ? $_SESSION['donation']['title'] : '';
        $type = isset($_SESSION['donation']['type']) ? $_SESSION['donation']['type'] : 'freshmeal';
        $expiryDate = isset($_SESSION['donation']['expiry_date']) ? $_SESSION['donation']['expiry_date'] : '';
        
        // Handle form submission: Update donation details
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Update donation details from form data
            $title = $_POST['title'];
            $type = $_POST['type'];
            $expiryDate = $_POST['expiry_date'];

            // Update session data
            $_SESSION['donation']['title'] = $title;
            $_SESSION['donation']['type'] = $type;
            $_SESSION['donation']['expiry_date'] = $expiryDate;

            // Handle add-ons (if any)
            if (isset($_POST['addon']) && $type === 'foodset') {
                $addonIndex = (int)$_POST['addon'];
                $_SESSION['donation']['addons'][] = $this->addons[$addonIndex];
            }

            // Handle removing add-ons
            if (isset($_POST['remove_addon'])) {
                $addonIndex = (int)$_POST['remove_addon'];
                unset($_SESSION['donation']['addons'][$addonIndex]);
                $_SESSION['donation']['addons'] = array_values($_SESSION['donation']['addons']);
            }

            // Redirect to show updated donation page (or stay on edit page if desired)
            header("Location: /editDonation");
            exit();
        }

        // Pass the data to the view for rendering
        $view = new EditDonationView();
        $view->render($title, $type, $expiryDate, $this->addons, $_SESSION['donation']['addons'], $this->baseFoodSet);
    }
}
