<?php

class User extends Model {

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

          public function validateInsertData($postedData) {
                foreach ($postedData as $key => $value) {
                    if (empty($value)) {
                        $this->errors[] = "The field $key is required";
                        return false;
                    }
                }
        
                if (!empty($postedData['username']) && $this->where("username", $postedData["username"])) {
                    $this->errors[] = "Username already exists in the system";
                    return false;
                }

                if(empty($this->errors)){
                    return true;
                }else{
                    return false;
                }
            }

          public function generateUserId($postedData){
                   $postedData["userid"] = randomString(10);
                   return $postedData;
          }

          public function hashPassword($postedData)
          {
                  $postedData["password"] = password_hash($postedData["password"], PASSWORD_DEFAULT);
                  return $postedData;
          }

          
}