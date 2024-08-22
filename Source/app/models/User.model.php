<?php

class User extends Model
{

    protected $allowedColumns = [
        "firstname",
        "lastname",
        "username",
        "password"
    ];

    protected $functionsBeforeInsert = [
        "generateUserId",
        "hashPassword"
    ];

    public function validateInsertData($postedData)
    {
        $this->errors = [];
        foreach ($postedData as $key => $value) {
            if (empty($value)) {
                $this->errors[] = "The field $key is required";
                return false;
            }
        }
        if (isset($postedData["password"]) && isset($postedData["cpassword"])) {
            if ($postedData["password"] !== $postedData["cpassword"]) {
                $this->errors[] = "Passwords do not match";
            }
        }

        if (isset($postedData['username'])) {
            if ($this->single("username", $postedData["username"])) {
                $this->errors[] = "Username already exists in the system";
                return false;
            }
        }

        if (empty($this->errors)) {
            return true;
        } else {
            return false;
        }
    }

    public function generateUserId($postedData)
    {
        $postedData["userid"] = randomString(10);
        return $postedData;
    }

    public function hashPassword($postedData)
    {
        $postedData["password"] = password_hash($postedData["password"], PASSWORD_DEFAULT);
        return $postedData;
    }

    public function register($postedData)
    {
        if ($this->validateInsertData($postedData)) {
            $this->insert($postedData);
        }
    }

    public function login()
    {
        $this->errors = [];
        $log = new Log();
        if ($row = $this->single("username", $_POST["username"])) {
            if (password_verify($_POST["password"], $row->password)) {
                // Clear the CSRF token after successful login
                unset($_SESSION['csrfToken']);
                Auth::authenticate($row);
                if ($log->insert($_POST)) {
                    return $row;
                } else {
                    $this->errors[] = "Error inserting logs";
                }
            } else {
                $this->errors[] = "Incorrect password";
            }
        } else {
            $this->errors[] = "Username doesn't exist in our system";
        }
        return false;
    }
}
