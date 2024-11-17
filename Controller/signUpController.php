<?php
require_once 'View\signUpView.php';

class SignUpController {
public function register() {
    $view = new SignUpView();
    echo $view->render();
}
}
?>