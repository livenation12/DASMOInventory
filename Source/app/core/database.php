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
                $conn = $this->connect();
                $stmt = $conn->prepare($query);

                if ($stmt) {
                        // Execute the statement
                        $check = $stmt->execute($data);

                        if ($check) {
                                // Check if it's a SELECT query
                                if (stripos(trim($query), 'SELECT') === 0) {
                                        // Fetch results based on data_type
                                        if ($data_type == "object") {
                                                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                                        } else {
                                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        }
                                        return $result;
                                } else {
                                        // For INSERT, UPDATE, DELETE, etc.
                                        return $stmt->rowCount(); // Return the number of affected rows
                                }
                        }
                }

                // Return false if the statement preparation or execution fails
                return false;
        }
}
