<?php
require_once 'View\showProfileView.php';
require_once 'Model\AbstractUser.php';
class ProfileController {
    public function showProfile() {
        // Sample data (you would fetch this from a database)
        $email=$_SESSION['user_email'];
        $user_role=$_SESSION['user_role'];
        //$user=unserialize($_SESSION['user']);
        $user_id=$_SESSION['user_id'];
        //$user->getUserByEmail($email);
        //$user_id=$user->getIdByEmail($email);
        //$user_role=$user->getRolebyEmail($email);
        
       
        $view = new ShowProfileView();

        
        // Check if the user is an organization or individual and render the appropriate profile
        if ( $user_role == 'Organization') {
            $user=new Organization("","","","",orgType::restaurant,"");
            $user->getUserbyId($user_id);
            $user->getOrganizationByID($user_id);
            $userData = [
                'email' => $user->getEmail(),
                'mobile' => $user->getMobile(),
                'usertype' => $user_role,
                'organizationType' => $user->getOrgType()->value,
                'title' => $user->getTitle(),
                'taxNumber' => $user->getTaxNumber(),
            ];
            $_SESSION['user']=serialize($user);
            echo $view->renderOrganizationProfile($userData);
        } elseif($user_role=='Volunteer') {
            $user=new Volunteer($email,"","","","","",0);
            $user->getUserbyId($user_id);
            $user->getInvidualByID($user_id);
            $userData = [
                'email' => $user->getEmail(),
                'mobile' => $user->getMobile(),
                'usertype' => $user_role,
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'ssn' => $user->getSSN(),
                'gender' => ($user->getGender() == true) ? 'Male' : 'Female',
            ];
            $_SESSION['user']=serialize($user);
            echo $view->renderIndividualProfile($userData);
        }
        elseif($user_role=='Benefeciary') {
            $user=new Benefeciary($email,"","","","","",0);
            $user->getUserbyId($user_id);
            $user->getInvidualByID($user_id);
            $userData = [
                'email' => $user->getEmail(),
                'mobile' => $user->getMobile(),
                'usertype' => $user_role,
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'ssn' => $user->getSSN(),
                'gender' => ($user->getGender() == true) ? 'Male' : 'Female',
            ];
            $_SESSION['user']=serialize($user);
            echo $view->renderIndividualProfile($userData);
        }
        elseif($user_role=='Donor') {
            $user=new Donor($email,"","","","","",0);
            $user->getUserbyId($user_id);
            $user->getInvidualByID($user_id);
            $userData = [
                'email' => $user->getEmail(),
                'mobile' => $user->getMobile(),
                'usertype' => $user_role,
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'ssn' => $user->getSSN(),
                'gender' => ($user->getGender() == true) ? 'Male' : 'Female',
            ];
            $_SESSION['user']=serialize($user);
            echo $view->renderIndividualProfile($userData);

        }elseif($user_role=='admin') {
            $user=new Benefeciary($email,"","","","","",0);
            $user->getUserbyId($user_id);
            $user->getInvidualByID($user_id);
            $userData = [
                'email' => $user->getEmail(),
                'mobile' => $user->getMobile(),
                'usertype' => $user_role,
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'ssn' => $user->getSSN(),
                'gender' => ($user->getGender() == true) ? 'Male' : 'Female',
            ];
            $_SESSION['user']=serialize($user);
            echo $view->renderIndividualProfile($userData);
        

        }


    }
}
