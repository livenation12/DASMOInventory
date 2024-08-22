<?php

class Item extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    protected $allowedColumns = [
        "itemId",
        "assetType",
        "propNumber",
        "serialNumber",
        "endUser",
        "quantity",
        "designation",
        "addedBy",
        "brand"
    ];


    private $canNullColumns = [
        "propNumber",
        "serialNumber",
        "endUser",
        "assetType",
        "brand",
    ];

    protected $functionsBeforeInsert = [
        "createItemId",
        "getEncoder",
    ];

    protected $functionsAfterSelect = [
        "formatSelectedData",
    ];

    protected $functionsAfterInsert = [
        "logActivity"
    ];

    protected function logActivity($data)
    {
        $activityLog = new Activitylog();
        $data["providerId"] = $data["addedBy"];
        $data["action"] = "ADDED";
        $data["consumerId"] = $data["itemId"];
        return $activityLog->insert($data);
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
    protected function createItemId($data)
    {
        $data["itemId"] = randomString(50);
        return $data;
    }

    protected function getEncoder($data)
    {
        $data["addedBy"] = Auth::getUserId();
        return $data;
    }

    protected function formatSelectedData($data)
    {
        $user = new User();
        if (!is_array($data)) {
            $userDetails = $user->single("userId", $data->addedBy);
            $data->encoder = $userDetails->firstname . " " . $userDetails->lastname;
        }
        return $data;
    }

    public function getAllBorrowedItems()
    {
        $query  = "SELECT COUNT(*) as borrowedItemsCount FROM $this->table WHERE currentLocation != ''";
        $data = $this->query($query);
        return $data[0]->borrowedItemsCount;
    }

    public function getAvailableItemCount()
    {
        $query = "SELECT COUNT(*) as availableItemsCount FROM $this->table WHERE inHouse = '1'";
        $data =  $this->query($query);
        return $data[0]->availableItemsCount;
    }
}
