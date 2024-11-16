<?php
require_once 'Controller/userController.php';
require_once 'Controller/createDonationController.php';  // Adjusted the path

$request = $_SERVER['REQUEST_URI'];
$controller = new UserController();  // Default to UserController for login and register routes

switch ($request) {
    case '/':
    case '/login':
        $controller->login();
        break;

    case '/register':
        $controller->register();
        break;

    case '/dashboard':
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        } else {
            echo "Welcome to the dashboard.";
        }
        break;

    case '/logout':
        session_start();
        session_destroy();
        header("Location: /login");
        break;

    // Add case for create donation route
    case '/create-donation':
        $donationController = new createDonationController();
        $donationController->createDonation();
        break;

    default:
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
        break;
}
