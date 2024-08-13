<?php

class Inventory extends Controller
{

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
                    echo json_encode(["payload" => $inventory ?? []]);
          }


          function add()
          {
                    if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST)) {
                              if (!isset($_POST['csrfToken']) || !Token::validateCSRFToken($_POST["csrfToken"])) {
                                        echo json_encode(['success' => false, 'error' => 'Invalid token.']);
                                        exit();
                              }
                              $errors = [];
                              $item = new Item();
                              $validate = $item->validateInsertedData($_POST);
                              if ($validate) {
                                        $isInserted = $item->insert($_POST);
                                        unset($_SESSION['csrfToken']);
                                        echo json_encode(['success' => true, "data" => $isInserted]);
                              } else {
                                        $errors = $item->errors;
                                        echo json_encode(['success' => false, 'error' => $errors]);
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
                    $this->view("item_details", [
                              "details" => $details,
                              "csrfToken" => $csrfToken,
                              "transactions" => $itemTransactions,
                              "activeTransaction" => $activeTransaction
                    ]);
          }

          function pullout()
          {
                    if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST)) {
                              if (!isset($_POST['csrfToken']) || !Token::validateCSRFToken($_POST["csrfToken"])) {
                                        echo json_encode(['success' => false, 'error' => 'Invalid token.']);
                                        exit();
                              }
                              $errors = [];
                              $transanction = new Transaction();
                              $insertTransaction = $transanction->insert($_POST);
                              if ($insertTransaction) {
                                        echo json_encode(['success' => true]);
                              } else {
                                        $errors = $transanction->errors;
                                        echo json_encode(['success' => false, 'error' => $errors]);
                              }
                    }
          }

          function update()
          {
                    if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST)) {
                              if (!isset($_POST['csrfToken']) || !Token::validateCSRFToken($_POST["csrfToken"])) {
                                        echo json_encode(['success' => false, 'error' => 'Invalid token.']);
                                        exit();
                              }
                              unset($_POST["csrfToken"]);
                              $errors = [];
                              $item = new Item();
                              $toUpdateItem = $item->single('itemId', $_POST["itemId"]);
                              if ($toUpdateItem) {
                                        $errors[] = "Item does not exist";
                              }
                              $id = $toUpdateItem->id;
                              $update = $item->update($id, $_POST);
                              if ($update) {
                                        echo json_encode(['success' => true]);
                              } else {
                                        $errors = $item->errors;
                                        echo json_encode(['success' => false, 'error' => $errors]);
                              }
                    }
          }

          function returnItem()
          {
                    if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST)) {
                              if (!isset($_POST['csrfToken']) || !Token::validateCSRFToken($_POST["csrfToken"])) {
                                        echo json_encode(['success' => false, 'error' => 'Invalid token.']);
                                        exit();
                              }
                              unset($_POST["csrfToken"]);
                              $errors = [];
                              $transactionId = $_POST["transactionId"];
                              $transaction = new Transaction();
                              $data["returnedDate"] = date("Y-m-d H:i:s");
                              $data["status"] = 0;
                              $data["receiverId"] = Auth::getUserId();
                              $update = $transaction->update($transaction->getIdByTableId("transactionId", $transactionId), $data);
                              if ($update) {
                                        $item = new Item();
                                        if (!($item->update($item->getIdByTableId("itemId", $_POST["itemId"]), ["currentLocation" => ""]))) {
                                                  $errors = $item->errors;
                                        }
                              } else {
                                        $errors = $transaction->errors;
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
                    $transactionDetails = $transaction->single("transactionId", $transactionId);
                    $this->view("transaction_details", ["transactionDetails" => $transactionDetails]);
          }

          function borrowed()
          {
                    $this->view("borrowed_items");
          }
}
