<?php
require_once 'AbstractUser.php';
require_once "DBConnection.php";
require_once 'PaymentFacade.php';
class Organization extends AbstractUser
{
    private string $title;
    private OrgType $orgType;
    private string $taxNumber;
    private PaymentFacade $payment;

    public function __construct(string $email, string $password, string $mobile, string $title, OrgType $orgType, string $taxNumber,)
    {
        
        parent::__construct($email, $password, $mobile);
        $this->title = $title;
        $this->taxNumber = $taxNumber;
        $this->orgType = $orgType;
        
        
    }
    public function getOrgType(){
        return $this->orgType;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getTaxNumber(){
        return $this->taxNumber;
    }
    public function addDonation(Donation $donation) {}

    public function setOrgInfo(){
        parent::setUserInfo('Organization');
        $user_id=parent::getIdByEmail(parent::getEmail());
        $conn = DBConnection::getInstance()->getConnection();
        $org_type=$this->orgType->value;
        $sql = "INSERT INTO organization (tax_number, user_id, title,orgtype) VALUES ('$this->taxNumber','$user_id','$this->title','$org_type')";
            if ($conn->query($sql)) {
                return true;
            } else {
                return false;
            }

    }

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


    
    public function pay (String $type,string $email,String $password,int $cardNumber ,int $cvv,FoodSet $foodSet):bool{ 
        $this->payment=new PaymentFacade();

        return $this->payment->pay($type,$email,$password,$cardNumber,$cvv,$foodSet->getCost());

    }

}




enum OrgType: string {
    case restaurant = 'restaurant';
    case shop = 'shop';
}
