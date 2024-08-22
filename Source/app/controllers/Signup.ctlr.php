<?php

class Signup extends Controller
{
  function index()
  {

    $csrfToken = Token::generateCSRFToken();

    $this->view(
      "signup",
      [
        "csrfToken" => $csrfToken
      ]
    );
  }
  function register()
  {
    $errors = [];
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      // Validate CSRF token
      if (!isset($_POST['csrfToken']) || !Token::validateCSRFToken($_POST['csrfToken'])) {
        $errors[] = "Invalid Token";
      } else {
        $user = new User();
        $user->register($_POST);
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
