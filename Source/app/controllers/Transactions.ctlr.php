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
}
