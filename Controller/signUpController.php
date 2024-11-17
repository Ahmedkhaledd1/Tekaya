<?php
require_once 'View/signUpView.php';
require_once 'Model\AbstractIndividual.php';
require_once 'Model\Organization.php';
require_once 'Model\Benefeciary.php';
require_once 'Model\Benefeciary.php';
require_once 'Model\Donor.php';
class SignUpController {
    public function register() {
        $view = new SignUpView();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $mobile = $_POST['mobile'];
            $userType = $_POST['userType'];

            // Handle user creation based on type
            try {
                if ($userType === 'organization') {
                    $organizationType=OrgType::from($_POST['organizationType']);
                    $organizationTitle = $_POST['organizationTitle'];
                    $taxNumber = $_POST['taxNumber'];
                    $organization = new Organization($email, $password, $mobile, $organizationTitle,$organizationType , $taxNumber);
                    $organization->setOrgInfo();  // Save organization-specific info
                } else {
                    $firstName = $_POST['firstName'];
                    $lastName = $_POST['lastName'];
                    $ssn = $_POST['ssn'];
                    $gender = ($_POST['gender'] === 'male'); // Convert to boolean
                    
                    // Use a subclass of AbstractIndividual based on specific userType if needed
                    if($_POST['userType']=='Volunteer'){
                        $individual = new Volunteer($email, $password, $mobile, $firstName, $lastName, $ssn, $gender);
                    }
                    elseif($_POST['userType']=='Beneficiary'){
                        $individual = new Benefeciary($email, $password, $mobile, $firstName, $lastName, $ssn, $gender);
                     }else{
                        $individual = new Donor($email, $password, $mobile, $firstName, $lastName, $ssn, $gender);
                     }
    
                     $response = $individual->setIndividualInfo();
                     echo $response;
                     if ($response === true) {
                         echo "Sign up successful!";
                     } else {
                         echo $response;  // This will show error messages, like 'Error: Duplicate entry for email'
                     }
                }
                header("Location: /login"); // Redirect to a success page
                exit();
            } catch (Exception $e) {
                echo $view->render("Error: " . $e->getMessage());
            }
        } else {
            echo $view->render(); // Render signup form
        }
    }
}
