<?php
class View {
    protected $title = "Tekaya"; // Default title
    protected $styles = []; // Array to hold stylesheets

    // Set the title of the page
    public function setTitle($title) {
        $this->title = $title;
    }

    // Add stylesheets
    public function addStyle($style) {
        $this->styles[] = $style;
    }

    // Render the HTML header
    public function renderHeader() {
        $styles = '';
        foreach ($this->styles as $style) {
            $styles .= "<link rel='stylesheet' href='{$style}'>\n";
        }

        return "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <meta http-equiv='X-UA-Compatible' content='ie=edge'>
            <title>{$this->title}</title>
            {$styles}
        </head>
        <body>";
    }


    public function renderNavbar($userType) {
        $navItems = '';
    
        switch ($userType) {
            case 'Organization':
            case 'Donor':
                $navItems = "
                    <li><a href='/profile'>Show Profile</a></li>
                    <li><a href='/createDonation'>Create Donation</a></li>
                    <li><a href='/sentDonations'>Show Sent Donations</a></li>
                ";
                break;
    
            case 'volunteer':
                $navItems = "
                    <li><a href='/profile'>Show Profile</a></li>
                    <li><a href='/receivedDonations'>Show Assigned Donations</a></li>
                ";
                break;
    
            case 'admin':
                $navItems = "
                    <li><a href='/profile'>Show Profile</a></li>
                    <li><a href='/dashboard'>Show All Donations</a></li>
                    <li><a href='/adminReport'>Generate Report</a></li>
                ";
                break;
    
            case 'Benefeciary':
                $navItems = "
                    <li><a href='/profile'>Show Profile</a></li>
                    <li><a href='/receivedDonations'>Show Received Donations</a></li>
                ";
                break;
        }
    
        return "
            <style>
                nav {
                    background-color: #333;
                    overflow: hidden;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                }
                nav ul {
                    list-style-type: none;
                    margin: 0;
                    padding: 0;
                    display: flex;
                    justify-content: center;
                }
                nav ul li {
                    padding: 14px 20px;
                }
                nav ul li a {
                    text-decoration: none;
                    color: white;
                    font-weight: bold;
                    transition: color 0.3s ease;
                }
                nav ul li a:hover {
                    color: #FFD700;
                }
                nav ul li a.active {
                    color: #FFD700;
                    border-bottom: 2px solid #FFD700;
                }
            </style>
            <nav>
                <ul>
                    {$navItems}
                    <li><a href='/logout'>Logout</a></li>
                </ul>
            </nav>
        ";
    }
    
    // Render the HTML footer
    public function renderFooter() {
        return "
        <footer>
            <p>&copy; " . date("Y") . " Your Company. All rights reserved.</p>
        </footer>
        </body>
        </html>";
    }
}
