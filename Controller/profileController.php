<?php
require_once 'View\showProfileView.php';

class ProfileController {
    public function showProfile() {
        // Sample data (you would fetch this from a database)
        $userData = [
            'email' => 'user@example.com',
            'password' => 'password123',
            'mobile' => '1234567890',
            'usertype' => 'organization',
            'organizationType' => 'NGO',
            'title' => 'Non-Profit Org',
            'taxNumber' => '123456789',
        ];
        $individualData = [
            'email' => 'user@example.com',
            'password' => 'userpassword123',
            'mobile' => '9876543210',
            'usertype' => 'individual',
            'firstName' => 'John',
            'lastName' => 'Doe',
            'ssn' => '123-45-6789',
            'gender' => 'male',
        ];
        $userData=$individualData;

        $view = new ShowProfileView();

        // Check if the user is an organization or individual and render the appropriate profile
        if ($userData['usertype'] == 'organization') {
            echo $view->renderOrganizationProfile($userData);
        } else {
            echo $view->renderIndividualProfile($userData);
        }
    }
}
