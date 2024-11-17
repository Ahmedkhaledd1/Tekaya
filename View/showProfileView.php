<?php
require_once __DIR__ . '/../core/View.php';

class ShowProfileView extends View {
    public function renderOrganizationProfile($organizationData) {
        
        $content = $this->renderHeader();
        $content .= "
        <div class='container'>
            <h2>Your Profile</h2>
            <p><strong>Email:</strong> {$organizationData['email']}</p>
            <p><strong>Mobile:</strong> {$organizationData['mobile']}</p>
            <p><strong>User Type:</strong> {$organizationData['usertype']}</p>
            <p><strong>Organization Type:</strong> {$organizationData['organizationType']}</p>
            <p><strong>Title:</strong> {$organizationData['title']}</p>
            <p><strong>Tax Number:</strong> {$organizationData['taxNumber']}</p>
        </div>";
        $content .= $this->renderFooter();
        return $content;
    }

    public function renderIndividualProfile($individualData) {
        $content = $this->renderHeader();
        $content .= "
        <div class='container'>
            <h2>Your Profile</h2>
            <p><strong>Email:</strong> {$individualData['email']}</p>
            <p><strong>Mobile:</strong> {$individualData['mobile']}</p>
            <p><strong>User Type:</strong> {$individualData['usertype']}</p>
            <p><strong>First Name:</strong> {$individualData['firstName']}</p>
            <p><strong>Last Name:</strong> {$individualData['lastName']}</p>
            <p><strong>SSN:</strong> {$individualData['ssn']}</p>
            <p><strong>Gender:</strong> {$individualData['gender']}</p>
        </div>";
        $content .= $this->renderFooter();
        return $content;
    }
}
