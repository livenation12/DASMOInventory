<?php

class Signup extends Controller
{
  function index()
  {
    $errors = [];
    $csrfToken = Token::generateCSRFToken();
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      // Validate CSRF token
      if (!isset($_POST['csrfToken']) || !Token::validateCSRFToken($_POST['csrfToken'])) {
        $errors[] = "Invalid token";
      } else {
        if ($_POST["password"] !== $_POST["cpassword"]) {
          $errors[] = "Passwords do not match";
        } else {
          $user = new User();
          if ($user->validateInsertData($_POST)) {
            if ($user->insert($_POST)) {
              $this->redirect('login');
            }
          } else {
            $errors = $user->errors;
          }
        }
      }
    }
    $this->view(
      "signup",
      [
        "errors" => $errors,
        "csrfToken" => $csrfToken
      ]
    );
  }
}
