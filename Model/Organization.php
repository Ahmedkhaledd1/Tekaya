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


    public function getUserbyId(int $id){
        // Check if email already exists in the database
        $conn = DBConnection::getInstance()->getConnection();
        $sql = "SELECT * FROM user WHERE id = '$id'";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            parent::__construct($row['email'],$row['password'],$row['mobile']);
        }
        else{
            return false;
        }
    }


    public function getOrganizationByID(int $id) {
        $conn = DBConnection::getInstance()->getConnection();
        $sql = "SELECT * FROM organization WHERE user_id = '$id'";
        $result = $conn->query($sql);
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
    
            $this->title = $row["title"];
            $this->taxNumber = $row["tax_number"];
            $orgTypeString = $row["orgtype"];
            switch ($orgTypeString) {
                case "restaurant":
                    $this->orgType = OrgType::restaurant;
                    break;
                case "shop":
                    $this->orgType = OrgType::shop;
                    break;
                default:
                    throw new Exception("Invalid orgtype value: $orgTypeString");
            }
    
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

