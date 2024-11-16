<?php
require_once 'View\loginView.php';
require_once 'View\signUpViwe.php';



class UserController {
    public function login() {
        $view = new LoginView();
        echo $view->render();
    }

    public function register() {
        $view = new SignUpView();
        echo $view->render();
    }
}
