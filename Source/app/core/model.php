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
                $data = $this->query(
                        $query,
                        [
                                "value" => $value
                        ]

                );
                //run methods after select
                if (is_array($data)) {
                        $data = $data[0];
                }
                if (property_exists($this, "functionsAfterSelect")) {
                        foreach ($this->functionsAfterSelect as $func) {
                                $data = $this->$func($data);
                        }
                }
                
                return $data;
        }


        public function insert($data)
        {
                // Remove unwanted columns
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
}
