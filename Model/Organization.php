<?php
require_once 'AbstractUser.php';
require_once "DBConnection.php";
class Organization extends AbstractUser
{
    private string $title;
    private OrgType $orgType;
    private string $taxNumber;

    public function __construct(string $email, string $password, string $mobile, string $title, OrgType $orgType, string $taxNumber,)
    {
        
        parent::__construct($email, $password, $mobile);
        $this->title = $title;
        $this->taxNumber = $taxNumber;
        $this->orgType = $orgType;
        
        
    }
    public function addDonation(Donation $donation) {}

    public function setOrgInfo(){

        $conn = DBConnection::getInstance()->getConnection();
        $sql = "INSERT INTO individual (tax_number, user_id, title,orgtype) VALUES ('$this->taxNumber',NULL,'$this->title','$this->orgType')";
            if ($conn->query($sql)) {
                return true;
            } else {
                return false;
            }

    }
}


enum OrgType
{
    case restaurant;
    case shop;
}
