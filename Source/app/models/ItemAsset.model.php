<?php

class ItemAsset extends Model
{
    private $cannotDuplicateColumns = [
        "asset"
    ];

    protected $allowedColumns = [
        "itemassetId",
        "asset"
    ];

    protected $functionsBeforeInsert  = [
        "createAssetId",

    ];

    private function validateInsertedData($data)
    {
        $this->errors = [];
        foreach ($data as $key => $value) {
            if(empty($value)){
                $this->errors[] = "All fields are required";
                return false;
            }
            if (in_array($key, $this->cannotDuplicateColumns)) {
                $hasDuplicate = $this->single($key, $value);
                if (!empty($hasDuplicate)) {
                    $this->errors[] = "Submitted data already exist";
                    return false;
                }
            }
        }
        return $data;
    }

    protected function createAssetId($data)
    {
        $data["itemassetId"] = randomString(50);
        return $data;
    }

    public function getAllAssetTypes()
    {
        return $this->findAll();
    }

    public function createNewAsset($postData)
    {
        if ($this->validateInsertedData($postData)) {
            return $this->insert($postData);
        }
        return false;
    }
}
