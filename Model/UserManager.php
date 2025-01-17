<?php
require_once 'UserFactory.php';

class UserManager
{

    public function addUser(string $type, $args): bool
    {
        $userFactory = new UserFactory();
        $newUser = $userFactory->createUser($type, $args);
        if (gettype($newUser) == "NULL") {
            return false;
        } else {
            return true;
        }
    }
}
