<?php
require_once 'AbstractUser.php';
require_once 'Organization.php';
require_once 'Donor.php';
require_once 'Volunteer.php';
require_once 'Benefeciary.php';
require_once 'Admin.php';

class UserFactory
{

    public function createUser(string $type, $args): AbstractUser
    {
        $user = null;
        switch ($type) {
            case 'Organization':
                $user  = new Organization($args[0], $args[1], $args[2], $args[3], $args[4], $args[5]);
                $user->setOrgInfo('Organization'); // Save organization-specific info
                break;
            case 'Donor':
                $user  = new Donor($args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6]);
                $user->setIndividualInfo('Donor');
                break;
            case 'Volunteer':
                $user  = new Volunteer($args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6]);
                $user->setIndividualInfo('Volunteer');
                break;

            case 'Benefeciary':
                $user  = new Benefeciary($args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6]);
                $user->setIndividualInfo('Benefeciary');
                break;

            case 'Admin':
                $user  = new Admin($args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6]);
                // $user->setIndividualInfo('Admin');
                break;

            default:

                break;
        }
        return $user;
    }
}
