<?php

class Login extends Controller
{
    function index()
    {
        if (Auth::isLogin()) {
            $this->redirect('home');
            exit();
        }

        $csrfToken = Token::generateCSRFToken();
        $this->view("login", [
            "csrfToken" => $csrfToken,
        ]);
    }
    function verify()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $errors = [];
            // Validate CSRF token
            if (!isset($_POST['csrfToken']) || !Token::validateCSRFToken($_POST['csrfToken'])) {
                $errors[] = "Invalid token";
            } else {
                $user = new User();
                $user->login($_POST);
                $errors = $user->errors;
            }
            if (empty($errors)) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "error" => $errors[0]]);
            }
        }
    }
}
