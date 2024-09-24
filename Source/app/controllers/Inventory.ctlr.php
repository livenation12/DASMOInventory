<?php

class Inventory extends Controller
{
    private $item;

    public function __construct()
    {
        $this->item = new Item();
    }

    function index()
    {
        $csrfToken = Token::generateCSRFToken();
        if (!Auth::isLogin()) {
            $this->redirect('login');
        }
        $this->view('inventory', ['csrfToken' => $csrfToken]);
    }

    function fetch()
    {
        $item = new Item();
        $inventory = $item->findAll();
        echo json_encode(['payload' => $inventory ?? []]);
    }


    function add()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
            if (!isset($_POST['csrfToken']) || !Token::validateCSRFToken($_POST['csrfToken'])) {
                $errors[] = 'Invalid token.';
            } else {
                unset($_SESSION['csrfToken']);
                $item = new Item();
                $item->create($_POST);
                
                $errors = $item->errors;
            }
            if (empty($errors)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => $errors[0]]);
            }
        }
    }
    function items($id)
    {
        $csrfToken = Token::generateCSRFToken();
        $item = new Item();
        $details = $item->single('itemId', $id);
        $transanction = new Transaction();
        $itemTransactions = $transanction->where('itemId', $id);
        $activeTransaction = null;
        if ($itemTransactions) {
            if (count($itemTransactions) > 0) {
                foreach ($itemTransactions as $transactionValue) {
                    if ($transactionValue->status &&  $transactionValue->pullOutType == 'Temporary') {
                        $activeTransaction = $transactionValue;
                        break;
                    }
                }
            }
        }
        $this->view('item_details', [
            'details' => $details,
            'csrfToken' => $csrfToken,
            'transactions' => $itemTransactions,
            'activeTransaction' => $activeTransaction
        ]);
    }
    private function mbConverter(int $numberMb)
    {
        return $numberMb * 1048576;
    }

    private function imageUploadErrorValidation($fileError)
    {
        switch ($fileError) {
            case UPLOAD_ERR_OK:
                return false; // No error, so return false (no validation error).
            case UPLOAD_ERR_INI_SIZE:
                return 'The uploaded file exceeds the system file size limit (php.ini).';
            case UPLOAD_ERR_FORM_SIZE:
                return 'The uploaded file exceeds the form file size limit.';
            case UPLOAD_ERR_PARTIAL:
                return 'The file was only partially uploaded.';
            case UPLOAD_ERR_NO_FILE:
                return 'No file was uploaded.';
            case UPLOAD_ERR_NO_TMP_DIR:
                return 'No temporary directory was found on the server.';
            case UPLOAD_ERR_CANT_WRITE:
                return 'Failed to write file to disk.';
            case UPLOAD_ERR_EXTENSION:
                return 'File upload was stopped by a PHP extension.';
            default:
                return 'Unknown upload error (code: ' . $fileError . ').';
        }
    }


    function pullout()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
            if (!isset($_POST['csrfToken']) || !Token::validateCSRFToken($_POST['csrfToken'])) {
                $errors[] = 'Invalid token.';
            } else {
                if (empty($_FILES['attachment'])) {
                    $errors[] = 'Please include an attachment.';
                } else {
                    $uploadValidation = $this->imageUploadErrorValidation($_FILES['attachment']['error']);
                    if ($uploadValidation) {
                        $errors[] = $uploadValidation;
                    } else {
                        // File should be only under 2MB
                        if ($_FILES['attachment']['size'] > $this->mbConverter(2)) {
                            $errors[] = 'The file is too large. Maximum file size is 2MB.';
                        }

                        // Check if the file is a PDF
                        $tmpName = $_FILES['attachment']['tmp_name'];
                        if (empty($tmpName)) {
                            $errors[] = 'Temporary file name is missing.';
                        } else {

                            //get the finfo class to get the mime type
                            $finfo = new finfo(FILEINFO_MIME_TYPE);
                            //get the mime type
                            $mimeType = $finfo->file($tmpName);
                            $allowedType = ['application/pdf'];
                            // Check if the file is on allowed types
                            if (!in_array($mimeType, $allowedType)) {
                                $errors[] = 'The file is not a PDF. Please upload a PDF.';
                            }
                        }

                        // If there are no errors, proceed with file handling
                        if (empty($errors)) {
                            $pathInfo = pathinfo($_FILES['attachment']['name']);
                            $base = $pathInfo['filename'];
                            $item = new Item();
                            $transaction = new Transaction();
                            $itemDetails = $item->single('itemId', $_POST['itemId']);
                            $base = $itemDetails->propNumber ? $itemDetails->propNumber : $itemDetails->serialNumber;
                            $base = preg_replace("/[^a-zA-Z0-9_-]/", "_", $base);
                            $uniquefier = $transaction->rowCount() + 1;
                            $filename = $base . '-' . $uniquefier . '.' . $pathInfo['extension'];
                            $fileDistination = dirname(__DIR__) . '/uploads/' . $filename;

                            // Move the uploaded file to the destination folder
                            if (!move_uploaded_file($tmpName, $fileDistination)) {
                                $errors[] = 'Cannot move file. Please try again.';
                            } else {
                                // Process further if no errors
                                $_POST['attachment'] = $filename;
                                unset($_SESSION['csrfToken']);
                                $transaction->pullout($_POST);
                                $errors = $transaction->errors;
                            }
                        }
                    }
                }
            }

            // Return response
            if (empty($errors)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => $errors[0]]);
            }
        }
    }

    function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $data["itemId"] = $id;
            $deleteItem = $this->item->delete($this->item->getIdByTableId('itemId', $id), $data);
            if (!$deleteItem) {
                $errors[] = 'Failed to delete item.';
            }
            if (empty($errors)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => $errors[0]]);
            }
        }
    }

    function update()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
            if (!isset($_POST['csrfToken']) || !Token::validateCSRFToken($_POST['csrfToken'])) {
                $errors[] = 'Invalid token.';
            } else {
                unset($_POST['csrfToken']);
                $item = new Item();
                if($item->updateItem($_POST)){
                    $item->logUpdateActivity($_POST);
                }
                $errors = $item->errors;
            }
            if (empty($errors)) {
                unset($_POST['csrfToken']);
                echo json_encode(['success' => true]);
            } else {
                $errors = $item->errors;
                echo json_encode(['success' => false, 'error' => $errors[0]]);
            }
        }
    }

    function returnItem()
    {
        $errors = [];
        date_default_timezone_set('Asia/Manila');
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
            if (!isset($_POST['csrfToken']) || !Token::validateCSRFToken($_POST['csrfToken'])) {
                $errors[] = 'Invalid token.';
            } else {
                unset($_POST['csrfToken']);
                $transactionId = $_POST['transactionId'];
                $transaction = new Transaction();
                $data['returnedDate'] = date('Y-m-d H:i:s');
                $data['status'] = 0;
                $data['receiverId'] = Auth::getUserId();
                $update = $transaction->update($transaction->getIdByTableId('transactionId', $transactionId), $data);
                if ($update) {
                    $item = new Item();
                    if (!($item->update($item->getIdByTableId('itemId', $_POST['itemId']), ['currentLocation' => '']))) {
                        $errors = $item->errors;
                    }
                } else {
                    $errors = $transaction->errors;
                }
            }
            if (!empty($errors)) {
                echo json_encode(['success' => false, 'error' => $errors[0]]);
            } else {
                echo json_encode(['success' => true]);
            }
        }
    }

    function transaction($transactionId)
    {
        $transaction = new Transaction();
        $transactionDetails = $transaction->single('transactionId', $transactionId);
        $this->view('transaction_details', ['transactionDetails' => $transactionDetails]);
    }

    function borrowed()
    {
        $this->view('borrowed_items');
    }
}
