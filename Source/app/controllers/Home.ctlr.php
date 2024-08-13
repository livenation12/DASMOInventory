<?php

class Home extends Controller
{


          function index()
          {
                    if (!Auth::isLogin()) {
                              $this->redirect('login');
                    }
                    $items = new Item();
                    $currentBorrowedItems = $items->getAllBorrowedItems();
                    $this->view('home', [
                              'currentBorrowedItems' => $currentBorrowedItems
                    ]);
          }
}
