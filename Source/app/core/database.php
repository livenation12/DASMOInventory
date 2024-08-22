<?php
class Database
{
        private function connect()
        {
                $conn = new PDO(DBDRIVER . ":host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASSWORD);
                if (!$conn) {
                        die("Cannot connect to database");
                }
                return $conn;
        }
        
        public function query($query, $data = [], $data_type = "object")
        {
            try {
                $conn = $this->connect();
                $stmt = $conn->prepare($query);
        
                if (!$stmt) {
                    throw new Exception('Statement preparation failed.');
                }
        
                // Bind parameters
                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                        // Automatically infer the PDO data type
                        $type = PDO::PARAM_STR;
                        if (is_int($value)) {
                            $type = PDO::PARAM_INT;
                        } elseif (is_bool($value)) {
                            $type = PDO::PARAM_BOOL;
                        } elseif (is_null($value)) {
                            $type = PDO::PARAM_NULL;
                        }
                        $stmt->bindValue(':' . $key, $value, $type);
                    }
                }
        
                // Execute the statement
                $check = $stmt->execute();
        
                if (!$check) {
                    throw new Exception('Statement execution failed: ' . implode(", ", $stmt->errorInfo()));
                }
        
                // Check if it's a SELECT query
                if (stripos(trim($query), 'SELECT') === 0) {
                    // Fetch results based on data_type
                    if ($data_type === "object") {
                        return $stmt->fetchAll(PDO::FETCH_OBJ);
                    } else {
                        return $stmt->fetchAll(PDO::FETCH_ASSOC);
                    }
                } else {
                    // For INSERT, UPDATE, DELETE, etc.
                    return $stmt->rowCount(); // Return the number of affected rows
                }
            } catch (Exception $e) {
                // Log the error
                error_log($e->getMessage());
                return false;
            }
        }
        
}
