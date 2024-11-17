<?php
require_once 'View\loginView.php';

class LoginController {
    public function login() {
        $view = new LoginView();
        echo $view->render();
    }
}
?>