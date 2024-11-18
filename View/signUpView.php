<?php
require_once __DIR__ . '/../core/View.php';

class SignUpView extends View {
    public function __construct() {
        // Set the title and add CSS for the page
        $this->setTitle("Signup Page");
        $this->addStyle("View/style.css");  // Correct path to style.css inside the View folder
    }

    public function render($message = '') {
        $content = $this->renderHeader();
        $content .= "
        <form method='POST' action='/register'>
            <h2>Sign Up</h2>";
        if (!empty($message)) {
            $content .= "<p style='color: red;'>{$message}</p>";
        }
        $content .= "
            <input type='email' name='email' placeholder='Email' required>
            <input type='password' name='password' placeholder='Password' required>
            <input type='text' name='mobile' placeholder='Mobile' required>
            
            <label for='userType'>User Type</label>
            <select name='userType' id='userType' onchange='toggleFields()' required>
                <option value='Organization'>Organization</option>
                <option value='Volunteer'>Volunteer</option>
                <option value='Beneficiary'>Beneficiary</option>
                <option value='Donor'>Donor</option>
            </select>
            
            <div id='organizationFields' style='display: none;'>
                <label for='organizationType'>Organization Type</label>
                <select name='organizationType' id='organizationType'>
                    <option value='restaurant'>Restaurant</option>
                    <option value='shop'>Shop</option>
                </select>
                <input type='text' name='organizationTitle' placeholder='Organization Title'>
                <input type='text' name='taxNumber' placeholder='Tax Number'>
            </div>
            
            <div id='individualFields' style='display: none;'>
                <input type='text' name='firstName' placeholder='First Name'>
                <input type='text' name='lastName' placeholder='Last Name'>
                <input type='text' name='ssn' placeholder='SSN'>
                <label for='gender'>Gender</label>
                <select name='gender' id='gender'>
                    <option value='male'>Male</option>
                    <option value='female'>Female</option>
                </select>
            </div>

            <button type='submit'>Sign Up</button>
        </form>
        
        <script>
            function toggleFields() {
                const userType = document.getElementById('userType').value;
                const orgFields = document.getElementById('organizationFields');
                const indFields = document.getElementById('individualFields');
                
                if (userType === 'Organization') {
                    orgFields.style.display = 'block';
                    indFields.style.display = 'none';
                } else {
                    orgFields.style.display = 'none';
                    indFields.style.display = 'block';
                }
            }
            window.onload = toggleFields;
        </script>";
        $content .= $this->renderFooter();
        return $content;
    }
}
