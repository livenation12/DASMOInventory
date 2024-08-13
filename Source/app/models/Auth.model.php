<?php


class Auth
{
          public static function authenticate($user)
          {
                    $_SESSION["userData"] = [
                              "userId" => $user->userId,
                              "fullname" => $user->firstname . " " . $user->lastname
                    ];
          }

          public static function logout()
          {
                    if (isset($_SESSION["userData"])) {
                              unset($_SESSION["userData"]);
                              unset($_SESSION);
                    }
          }

          public static function isLogin()
          {
                    return isset($_SESSION["userData"]);
          }


          /**
           * Magic method to get properties from the authenticated user.
           *
           * This method is used to dynamically retrieve properties from the authenticated user.
           * It takes a method name as the first parameter and an array of parameters as the second parameter.
           * The method name is expected to start with "get" followed by the property name in camel case.
           * For example, to get the user's name, the method name should be "getName".
           * If the property exists in the user's session data, it will be returned.
           * Otherwise, "Unknown" will be returned.
           *
           * @param string $method The method name called.
           * @param array $params An array of parameters passed to the method.
           * @return mixed The value of the property or "Unknown".
           */    public static function __callStatic($method, $params)
          {
                    // Check if the method name starts with 'get'
                    if (substr($method, 0, 3) === 'get') {
                              // Extract the property name from the method name
                              $prop = strtolower(substr($method, 3));

                              // Check if userData exists in the session and is an array
                              if (isset($_SESSION["userData"]) && is_array($_SESSION["userData"])) {
                                        // Convert the array keys to lowercase for case-insensitive access
                                        $userData = array_change_key_case($_SESSION["userData"], CASE_LOWER);

                                        // Check if the property exists in the user's session data
                                        if (isset($userData[$prop])) {
                                                  // Return the value of the property
                                                  return $userData[$prop];
                                        }
                              }
                    }
                    // If the method doesn't start with 'get' or the property doesn't exist, return "Unknown"
                    return "Unknown";
          }
}
