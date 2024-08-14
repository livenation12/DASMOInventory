<?php

class Transactions extends Controller
{
          public function index()
          {
                    $transaction = new Transaction();
                    $transactions = $transaction->getFullTransactionDetails();
                    $this->view("transactions", ["transactions" => $transactions]);
          }
}
