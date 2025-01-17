<?php
class XMLReport extends AbstractUserReportTemplate
{

    protected function generateReport($donorId): string
{
    // Fetch the user and organization data
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

    
    $doc = new DOMDocument('1.0', 'UTF-8');
    $doc->formatOutput = true;

    
    $root = $doc->createElement('UserReport');
    $doc->appendChild($root);

    
    foreach ($userData as $key => $value) {
        $element = $doc->createElement($key, htmlspecialchars($value));
        $root->appendChild($element);
    }

    // Define the path to save the XML file
    $filePath = __DIR__ . "/UserReport_{$donorId}.xml";

    // Save the XML file
    if ($doc->save($filePath)) {
        echo "XML report generated and saved successfully at: {$filePath}\n";
    } else {
        echo "Failed to save the XML report.\n";
    }


    $donations = Donation::getDonationsByDonorID($donorId);

    return $filePath;

}

}