<?php


class  ItemAssets extends Controller
{
    public function index()
    {
        $asset = new ItemAsset();
        echo json_encode(["payload" => $asset->getAllAssetTypes()]);
    }

    public function create()
    {
        $errors = [];
        if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST)) {
            if (!isset($_POST['csrfToken']) || !Token::validateCSRFToken($_POST["csrfToken"])) {
                $errors[] = (['success' => false, 'error' => 'Invalid token.']);
            }
            $asset = new ItemAsset();
            if (!$asset->createNewAsset($_POST)) {
                $errors = $asset->errors;
            }
            if (empty($errors)) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "error" => $errors[0]]);
            }
        }
    }
}
