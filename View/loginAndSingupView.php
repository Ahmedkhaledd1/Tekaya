<?php

require_once __DIR__ . '/../core/View.php'; // Include the base View class

class LoginAndSignupView extends View {
    public function __construct() {
        // Set the title and add CSS for the page
        $this->setTitle("Login & Signup Page");
        $this->addStyle("View/style.css"); // Correct path to style.css inside the View folder
    }

    // Render the page
    public function render() {
        echo $this->renderHeader(); // Render the header from the base class

        echo "
        <main>
            <div class='container'>
                <!-- Toggle between Login and Signup forms -->
                <input type='checkbox' id='check'>

                <!-- Login Form -->
                <div class='login form'>
                    <header><b>Login</b></header>
                    <form method='POST' action='/login'>
                        <input type='email' name='email' placeholder='Enter your email' required>
                        <input type='password' name='password' placeholder='Enter your password' required>
                        <a href='#'>Forgot password?</a>
                        <button type='submit' class='button'>Login</button>
                    </form>
                    <div class='signup'>
                        <span>Don't have an account?
                            <label for='check'>Signup</label>
                        </span>
                    </div>
                </div>
                
                <!-- Signup Form -->
                <div class='registration form'>
                    <header><b>Signup</b></header>
                    <form method='POST' action='/register'>
                        <!-- Required fields for Signup -->
                        <input type='email' name='email' placeholder='Enter your email' required>
                        <input type='password' name='password' placeholder='Create a password' required>
                        <input type='password' name='confirm_password' placeholder='Confirm your password' required>
                        
                        <!-- New fields for Signup -->
                        <input type='text' name='fname' placeholder='First Name' required>
                        <input type='text' name='lname' placeholder='Last Name' required>
                        <input type='text' name='ssn' placeholder='SSN' required>
                        <select name='gender' required>
                            <option value=''>Select Gender</option>
                            <option value='male'>Male</option>
                            <option value='female'>Female</option>
                        </select>
                        <input type='text' name='mobile' placeholder='Mobile Number' required>
                        <input type='text' name='address' placeholder='Address' required>
                        
                        <button type='submit' class='button'>Signup</button>
                    </form>
                    <div class='signup'>
                        <span>Already have an account?
                            <label for='check'>Login</label>
                        </span>
                    </div>
                </div>
            </div>
        </main>
        ";

        echo $this->renderFooter(); // Render the footer from the base class
    }
}
?>