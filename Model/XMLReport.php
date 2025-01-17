<?php

require_once 'AbstractUserReportTemplate.php';
require_once 'Organization.php';
require_once 'Donation.php';
class XMLReport extends AbstractUserReportTemplate
{

    protected function generateReport($donorId): string
    {
        $user = new Organization("", "", "", "", orgType::restaurant, "");
        $user->getUserbyId($donorId);
        $user->getOrganizationByID($donorId);
    
        $userData = [
            'email' => $user->getEmail(),
            'mobile' => $user->getMobile(),
            'organizationType' => $user->getOrgType()->value,
            'title' => $user->getTitle(),
            'taxNumber' => $user->getTaxNumber(),
        ];
    
        $donations = Donation::getDonationsByDonorID($donorId);
    
        $doc = new DOMDocument('1.0', 'UTF-8');
        $doc->formatOutput = true;
    
        $root = $doc->createElement('UserReport');
        $doc->appendChild($root);
    
        $userElement = $doc->createElement('UserData');
        foreach ($userData as $key => $value) {
            $element = $doc->createElement($key, htmlspecialchars($value));
            $userElement->appendChild($element);
        }
        $root->appendChild($userElement);
    
        $donationsElement = $doc->createElement('Donations');
        foreach ($donations as $donation) {
            $donationElement = $doc->createElement('Donation');
            foreach ($donation as $key => $value) {
                $element = $doc->createElement($key, htmlspecialchars((string)$value));
                $donationElement->appendChild($element);
            }
            $donationsElement->appendChild($donationElement);
        }
        $root->appendChild($donationsElement);
    
        $filePath = dirname(__DIR__) . "\UserReport_{$donorId}.xml";
    
        if ($doc->save($filePath)) {
            echo "XML report generated and saved successfully at: {$filePath}\n";
        } else {
            echo "Failed to save the XML report.\n";
        }

        return $filePath;
    }
    
    
}
