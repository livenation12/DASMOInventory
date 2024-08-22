<?php

class Home extends Controller
{


    function index()
    {
        if (!Auth::isLogin()) {
            $this->redirect("login");
        }
        $item = new Item();
        $currentBorrowedItems = $item->getAllBorrowedItems();
        $transaction = new Transaction();
        $transactions = $transaction->getWeeklyCount();
        $availableItemsCount = $item->getAvailableItemCount();
        $this->view("home", [
            "currentBorrowedItems" => $currentBorrowedItems,
            "transactions" => $transactions,
            "availableItemsCount" => $availableItemsCount
        ]);
    }
}
