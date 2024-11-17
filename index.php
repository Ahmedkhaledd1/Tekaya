<?php
require_once 'Controller\userController.php';
//require_once 'Controller\profileController.php';
//require_once 'Controller\sentDonationsController.php';
//require_once 'Controller\receivedDonationsController.php';
require_once 'Controller/createDonationController.php';  // Adjusted the path
require_once 'Controller\editDonationController.php';
$request = $_SERVER['REQUEST_URI'];
$controller = new UserController();
//$profilecontroller = new ProfileController();
//$sentDonationsController=new SentDonationController();
//$receivedDonationsController=new ReceivedDonationsController();
$donationController = new createDonationController();
$editdonationController = new EditDonationController();
switch ($request) {
    case '/':
    case '/login':
        $controller->login();
        break;

    case '/register':
        $controller->register();
        break;

    /*case '/profile':
        $profilecontroller->showProfile();  // Show profile route
        break;
    case '/sentDonations':
        $sentDonationsController->showSentDonations();  // Show profile route
        break;

    case '/receivedDonations':
        $receivedDonationsController->showReceivedDonations();  // Show profile route
        break;*/

    case '/editDonation':
        $editdonationController->showEditDonation();
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
    case '/createDonation':
        
        $donationController->showCreateDonation();
        break;

    default:
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
        break;
}
