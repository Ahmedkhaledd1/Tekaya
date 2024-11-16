<?php
require_once __DIR__ . '/../Core/View.php';

class LoginView extends View {
    public function __construct() {
        // Set the title and add CSS for the page
        $this->setTitle("Login Page");
        $this->addStyle("View/style.css"); // Correct path to style.css inside the View folder
    }
    public function render($message = '') {
        $content = $this->renderHeader();
        $content .= "
        <div class='container'>
        <form method='POST' action='/login'>
            <h2>Login</h2>";
        if (!empty($message)) {
            $content .= "<p style='color: green;'>{$message}</p>";
        }
        $content .= "
            <input type='email' name='email' placeholder='Email' required>
            <input type='password' name='password' placeholder='Password' required>
            <button type='submit'>Login</button>
            <p>Don't have an account? <a href='/register'>Sign Up</a></p>
        </form>
        </div>";
        $content .= $this->renderFooter();
        return $content;
    }
}
