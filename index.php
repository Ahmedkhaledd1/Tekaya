<?php
// Include the View.php file (base class)
require_once __DIR__ . '/Core/View.php';

// Include the loginAndSingupView.php file (view for login and signup)
require_once __DIR__ . '/View/loginAndSingupView.php';  // Correct path based on your directory structure

// Instantiate the LoginAndSignupView and render it
$view = new LoginAndSignupView();
$view->render();
