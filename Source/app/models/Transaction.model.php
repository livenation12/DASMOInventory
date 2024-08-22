<?php

class Transaction extends Model
{
    protected $allowedColumns = [
        "itemId",
        "approverId",
        "pullOutType",
        "puller",
        "fromLocation",
        "toLocation",
        "returnDate",
        "returnedDate",
        "status",
    ];
    protected $functionsBeforeInsert = ["createTransactionId", "getApproverId", "insertPullOutDate", "setActiveStatus"];
    protected $functionsAfterInsert = ["handlePullOutType"];
    protected $functionsAfterSelectFullDetails = ["formatFullDetailsData"];
    protected $functionsAfterSelect = ["getApproverName", "getReceiverName"];
    protected $canNullColumns = [];
    protected function handlePullOutType($data)
    {
        $errors = [];
        $item = new Item();
        $toUpdateItem = $item->single("itemId", $data["itemId"]);

        if ($data["pullOutType"] === "Temporary") {
            if (!$item->update($toUpdateItem->id, ["currentLocation" => $data["toLocation"]])) {
                $errors = $item->errors;
            }
        } elseif ($data["pullOutType"] === "Permanent") {
            if (!$item->update($toUpdateItem->id, ["designation" => $data["toLocation"]])) {
                $errors = $item->errors;
            }
        }

        if (empty($errors)) {
            return $data; // Return data if successful
        }
        return false;
    }

    public function validateInsertedData($data)
    {

        // Initialize an empty array for errors
        $this->errors = [];
        // Check each key-value pair in the data
        foreach ($data as $key => $value) {
            // Check if the key is in the allowed null columns
            if (in_array($key, $this->canNullColumns)) {
                // If the value is empty and can be null, skip further checks
                if (empty($value)) {
                    continue;
                }
            }
            // Perform other validation checks here
            // For example, check if the value is required or if it has a valid format

            // Example: Check if the value is required
            if (!in_array($key, $this->canNullColumns) && empty($value)) {
                $this->errors = "Please fill al required fields";
                return false;
            }
            // Add more validation rules as necessary
        }
        // If there are errors, return the errors array
        return empty($this->errors);
    }

    protected function getApproverId($data)
    {
        $data["approverId"] = Auth::getUserId();
        return $data;
    }

    protected function createTransactionId($data)
    {

        $data["transactionId"] = randomString(50);
        return $data;
    }

    protected function insertPullOutDate($data)
    {
        date_default_timezone_set('Asia/Manila');
        $data["pullOutDate"] = date("Y-m-d H:i:s");
        return $data;
    }

    protected function setActiveStatus($data)
    {
        if ($data["pullOutType"] === "Temporary") {
            $data["status"] = 1;
        }
        return $data;
    }

    protected function getReceiverName($data)
    {
        $user = new User();
        if (is_array($data)) {
            foreach ($data as $value) {
                if ($value->receiverId) {
                    $getUser = $user->single("userId", $value->receiverId);
                    $value->receiverName = $getUser->firstname . " " . $getUser->lastname;
                }
            }
        }
        if (!is_array($data)) {
            if ($data->receiverId) {
                $getUser = $user->single("userId", $data->receiverId);
                $data->receiverName = $getUser->firstname . " " . $getUser->lastname;
            }
        }

        return $data;
    }


    protected function getApproverName($data)
    {
        $user = new User();
        if (is_array($data)) {
            foreach ($data as $value) {
                if ($value->approverId) {
                    $getUser = $user->single("userId", $value->approverId);
                    $value->approverName = $getUser->firstname . " " . $getUser->lastname;
                }
            }
        }
        if (!is_array($data)) {
            if ($data->approverId) {
                $getUser = $user->single("userId", $data->approverId);
                $data->approverName = $getUser->firstname . " " . $getUser->lastname;
            }
        }
        return $data;
    }

    protected function formatFullDetailsData($data)
    {
        if (is_array($data)) {
            foreach ($data as $value) {
                $value->pullOutDate = formatDate($value->pullOutDate);
                $value->returnedDate = formatDate($value->returnedDate);
            }
            return $data;
        }
        return false;
    }

    public function getFullTransactionDetails()
    {
        return $this->fullDetails("items");
    }

    public function getWeeklyCount()
    {
        $query = "SELECT 
                    CONCAT('Week ', 
                        FLOOR((DAY(pullOutDate) - 1) / 7) + 1
                    ) AS week_label,
                    COUNT(*) AS transaction_count
                FROM 
                    transactions
                WHERE 
                    YEAR(pullOutDate) = YEAR(CURDATE()) AND
                    MONTH(pullOutDate) = MONTH(CURDATE())
                GROUP BY 
                    week_label
                ORDER BY 
                    week_label
";
        return $this->query($query);
    }
}
