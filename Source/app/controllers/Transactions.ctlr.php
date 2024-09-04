<?php

class Transactions extends Controller
{
    function index()
    {
        $transaction = new Transaction();
        $transactions = $transaction->getFullTransactionDetails();
        $this->view("transactions", ["transactions" => $transactions]);
    }

    function fetch()
    {
        $transaction = new Transaction();
        $transactionFullDetails = $transaction->getFullTransactionDetails();
        echo json_encode(["payload" => $transactionFullDetails]);
    }

    function weekly_count()
    {
        $transaction = new Transaction();
        $transactions = $transaction->getWeeklyCount();
        echo json_encode(["payload" => $transactions]);
    }

    public function borrowed_count()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $item = new Item();
            $filter = isset($_POST["filter"]) ? $_POST["filter"] : ''; // Ensure filter is set
            $count = $item->countBorrowedItemsByMonthFilterByAssetType($filter);

            if ($count !== false) {
                echo json_encode(["success" => true, "payload" => $count]);
            } else {
                echo json_encode(["success" => false, "error" => "Failed to fetch data"]);
            }
        } else {
            echo json_encode(["success" => false, "error" => "Invalid request method"]);
        }
    }
}
