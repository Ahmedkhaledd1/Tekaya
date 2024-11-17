<?php
require_once 'View/CreateDonationView.php';

class CreateDonationController {
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

    public function showCreateDonation() {
        // Initialize data from POST or session
        $title = isset($_POST['title']) ? $_POST['title'] : $_SESSION['donation']['title'];
        $type = isset($_POST['type']) ? $_POST['type'] : $_SESSION['donation']['type'];
        $expiryDate = isset($_POST['expiry_date']) ? $_POST['expiry_date'] : $_SESSION['donation']['expiry_date'];

        // Handle form submission: Add add-on
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Add add-on to session
            if (isset($_POST['addon']) && $type === 'foodset') {
                $addonIndex = (int)$_POST['addon'];
                $_SESSION['donation']['addons'][] = $this->addons[$addonIndex];
            }

            // Handle remove add-on
            if (isset($_POST['remove_addon'])) {
                $addonIndex = (int)$_POST['remove_addon'];
                unset($_SESSION['donation']['addons'][$addonIndex]);
                $_SESSION['donation']['addons'] = array_values($_SESSION['donation']['addons']);
            }

            // Handle other form data (title, type, expiry_date)
            $_SESSION['donation']['title'] = $title;
            $_SESSION['donation']['type'] = $type;
            $_SESSION['donation']['expiry_date'] = $expiryDate;
        }

        // Update description and cost based on selected add-ons
        $description = $this->baseFoodSet['description'];
        $cost = $this->baseFoodSet['cost'];
        foreach ($_SESSION['donation']['addons'] as $addon) {
            $description .= ', ' . $addon['name'];
            $cost += $addon['cost'];
        }

        // Pass the necessary data to the view
        $view = new CreateDonationView();
        $view->render($title, $type, $description, $cost, $this->addons, $expiryDate, $_SESSION['donation']['addons']);
    }

    public function confirmDonation() {
        $_SESSION['donation'] = []; // Clear session after confirmation
        header("Location: /showmydonation");
        exit();
    }
}
