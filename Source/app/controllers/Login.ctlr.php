<?php

class Login extends Controller
{
    function index()
    {
        if (Auth::isLogin()) {
            $this->redirect('home');
            exit();
        }
        $errors = [];
        $csrfToken = Token::generateCSRFToken();
        if (isset($_POST["login"])) {
            // Validate CSRF token
            if (!isset($_POST['csrfToken']) || !Token::validateCSRFToken($_POST['csrfToken'])) {
                $errors[] = "Invalid token";
            } else {
                $user = new User();
                $log = new Log();
                if ($row = $user->where("username", $_POST["username"])) {
                    $row = $row[0];
                    if (password_verify($_POST["password"], $row->password)) {
                        $_POST["attempt"] = "success";
                        $log->insert($_POST);
                        // Clear the CSRF token after successful login
                        unset($_SESSION['csrfToken']);
                        $_SESSION["login_success"] = true;
                        Auth::authenticate($row);
                        $this->redirect('home');
                        exit();
                    } else {
                        $errors[] = "Password incorrect";
                    }
                } else {
                    $errors[] = "User does not exist in our system";
                }

                if (!empty($errors)) {
                    $log->insert($_POST);
                }
            }
        }

        $this->view("login", [
            "errors" => $errors,
            "csrfToken" => $csrfToken
        ]);
    }
}
