<?php
require_once 'Model/AbstractUser.php';
require_once 'View/LoginView.php';
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
class LoginController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve and sanitize input
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            // Validate email format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->renderWithMessage("Invalid email format.");
                return;
            }

            // Create a user instance to check credentials
            $user = new class($email, '', '') extends AbstractUser {
                // Anonymous class for user lookup only
            };

            if ($user->getUserByEmail($email)) {
                // Check if passwords match
                if ($password === $user->getPassword()) {
                    // Store the user in the session
                    $user->getUserByEmail($email);
                    session_start();
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user_password'] = $password;
                    $_SESSION['user_role']=$user->getRolebyEmail($email);
                    $_SESSION['user_id']=$user->getIdByEmail($email);
                    //$_SESSION['user']=serialize($user);
                    // Redirect to a dashboard or home page
                    header("Location: /profile");
                    exit();
                } else {
                    $this->renderWithMessage("Incorrect password.");
                }
            } else {
                $this->renderWithMessage("User not found.");
            }
        } else {
            // Render the login form
            $view = new LoginView();
            echo $view->render();
        }
    }

    private function renderWithMessage(string $message)
    {
        $view = new LoginView();
        echo $view->render($message);
    }
}
