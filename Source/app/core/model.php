<?php

class Model extends Database
{
        public $errors = [];
        public function __construct()
        {
                if (!property_exists($this, "table")) {
                        $this->table = strtolower($this::class) . "s";
                }
        }

        public function findAll()
        {
                $query = "SELECT * FROM $this->table ORDER BY id DESC";
                $data = $this->query($query);
                //run methods after select
                if (is_array($data)) {
                        if (property_exists($this, "functionsAfterSelect")) {
                                foreach ($this->functionsAfterSelect as $func) {
                                        $data = $this->$func($data);
                                }
                        }
                }
                return $data;
        }

        public function where($column, $value)
        {
                $query = "SELECT * FROM $this->table WHERE $column = :value ORDER BY id DESC";
                $data = $this->query(
                        $query,
                        [
                                "value" => $value
                        ]

                );
                //run methods after select
                if (is_array($data)) {
                        if (property_exists($this, "functionsAfterSelect")) {
                                foreach ($this->functionsAfterSelect as $func) {
                                        $data = $this->$func($data);
                                }
                        }
                }
                return $data;
        }

        public function single($column, $value)
        {

                $query = "SELECT * FROM $this->table WHERE $column = :value";
                if ($data = $this->query(
                        $query,
                        [
                                "value" => $value
                        ]

                )) {
                        $data = $data[0];
                        if (property_exists($this, "functionsAfterSelect")) {
                                foreach ($this->functionsAfterSelect as $func) {
                                        $data = $this->$func($data);
                                }
                                return $data;
                        }
                        return $data;
                }
                return false;
        }
        private $sensitiveData = [
                "password",
                "cpassword"
        ];

        public function sanitize($data)
        {
                // If $data is an array, sanitize each element individually
                if (is_array($data)) {
                        foreach ($data as $key => $value) {
                                // Check if the key is in the sensitive data list
                                if (in_array($key, $this->sensitiveData)) {
                                        // Skip sanitizing sensitive data
                                        continue;
                                }
                                // Sanitize the value
                                $data[$key] = filter_var($value, FILTER_SANITIZE_STRING);
                        }
                        return $data;
                }

                // Handle cases where $data is not an array
                if (is_string($data)) {
                        return filter_var($data, FILTER_SANITIZE_STRING);
                }

                // Handle invalid data type
                $this->errors[] = 'Invalid data';
                return null;
        }

        public function insert($data)
        {
                // Remove unwanted columns
                $data = $this->sanitize($data);
                if (property_exists($this, "allowedColumns")) {
                        foreach ($data as $key => $columns) {
                                if (!in_array($key, $this->allowedColumns)) {
                                        unset($data[$key]);
                                }
                        }
                }
                // Functions to run before insert
                if (property_exists($this, "functionsBeforeInsert")) {
                        foreach ($this->functionsBeforeInsert as $func) {
                                $data = $this->$func($data);
                        }
                }
                $keys = array_keys($data);
                $columns = implode(",", $keys);
                $values = implode(",:", $keys);
                $query = "INSERT INTO $this->table ($columns) VALUES (:$values)";
                $insert = $this->query($query, $data);
                if ($insert) {
                        if (property_exists($this, "functionsAfterInsert")) {
                                foreach ($this->functionsAfterInsert as $func) {
                                        $finalData = $this->$func($data);
                                }
                                return $finalData;
                        }
                        return $insert;
                }
                return false;
        }

        public function update($id, $data)
        {
                // Functions to run before update
                if (property_exists($this, "beforeUpdate")) {
                        foreach ($this->beforeUpdate as $func) {
                                $data = $this->$func($data);
                        }
                }
                $string = "";
                foreach ($data as $key => $value) {
                        $string .= $key . "= :" . $key . ", ";
                }
                $string = trim($string, ", ");

                $data["id"] = $id;
                $query = "UPDATE $this->table SET $string WHERE id = :id";
                return $this->query($query, $data);
        }


        public function delete($id)
        {
                $data["id"] = $id;
                $query = "DELETE FROM $this->table WHERE id = :id";
                return  $this->query($query, $data);
        }
        public function getIdByTableId($tableCol, $tableId)
        {
                $result = $this->single($tableCol, $tableId);

                // Check if $result is an object and has the 'id' property
                if (is_object($result) && property_exists($result, 'id')) {
                        return $result->id;
                } else {
                        $this->errors[] = "Document not found";
                        // Handle the case where 'id' is not set or $result is not an object
                        return null; // or throw new Exception("ID not found");
                }
        }

        public function fullDetails($joinTable)
        {
                $referenceId = rtrim($joinTable, "s") . "Id";
                $query =  "SELECT * FROM $this->table INNER JOIN $joinTable ON $this->table.$referenceId=$joinTable.$referenceId";
                $data = $this->query($query);
                if ($data) {
                        if (property_exists($this, "functionsAfterSelectFullDetails")) {
                                foreach ($this->functionsAfterSelectFullDetails as $func) {
                                        $data = $this->$func($data);
                                }
                        }
                }
                return $data;
        }
}
