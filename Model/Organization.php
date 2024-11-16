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
        $conn = DBConnection::getInstance()->getConnection();
        parent::__construct($email, $password, $mobile);
        $this->title = $title;
        $this->taxNumber = $taxNumber;
        $this->orgType = $orgType;
        $sql = "INSERT INTO individual (tax_number, user_id, title,orgtype) VALUES ('$taxNumber',NULL,'$title','$orgType')";
        $conn->query($sql);
    }
    public function addDonation(Donation $donation) {}
}

enum OrgType
{
    case restaurant;
    case shop;
}
