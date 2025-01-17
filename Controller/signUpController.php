<?php
require_once 'View/signUpView.php';
require_once 'Model\AbstractIndividual.php';
require_once 'Model\Organization.php';
require_once 'Model\Volunteer.php';
require_once 'Model\Benefeciary.php';
require_once 'Model\Donor.php';
require_once 'Model\UserManager.php';

class SignUpController
{
    public function register()
    {
        $view = new SignUpView();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $mobile = $_POST['mobile'];
            $userType = $_POST['userType'];

            // Handle user creation based on type
            $userManager = new UserManager();
            try {
                if ($userType === 'Organization') {
                    $organizationType = OrgType::from($_POST['organizationType']);
                    $organizationTitle = $_POST['organizationTitle'];
                    $taxNumber = $_POST['taxNumber'];
                    $userManager->addUser($userType, array($email, $password, $mobile, $organizationTitle, $organizationType, $taxNumber));
                } else {
                    $firstName = $_POST['firstName'];
                    $lastName = $_POST['lastName'];
                    $ssn = $_POST['ssn'];
                    $gender = ($_POST['gender'] === 'male'); // Convert to boolean

                    // Use a subclass of AbstractIndividual based on specific userType if needed
                    $created = $userManager->addUser($userType, array($email, $password, $mobile, $firstName, $lastName, $ssn, $gender));

                    if ($created) {
                        echo "Sign up successful!";
                    } else {
                        echo "Sign up failed!";
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
