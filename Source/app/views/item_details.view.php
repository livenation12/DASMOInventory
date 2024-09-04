<?php $this->view("includes/header"); ?>
<div class="mt-3">
          <a onclick="history.back()"><i class="fa-solid fa-arrow-left ms-2 my-2"></i>
                    <strong class="text-xl font-bold tracking-wide ms-2">Item Details</strong>
          </a>
          <div class="grid grid-cols-1 lg:grid-cols-3">
                    <div class="col-span-2 relative">
                              <div class="overflow-x-auto rounded-xl text-sm p-5 border-2 my-2 shadow-xl text-white bg-slate-700">
                                        <div class="grid md:grid-cols-3 my-3 text-white/80 gap-y-2 mx-3">
                                                  <strong class="text-base">Description:</strong><i class="col-span-2"><?= ($details->assetType ?? '') . " " . ($details->brand ?? '') ?></i>
                                                  <strong class="text-base">Property number:</strong><i class="col-span-2"><?= $details->propNumber ?></i>
                                                  <strong class="text-base">Serial number:</strong><i class="col-span-2"><?= $details->serialNumber ?></i>
                                                  <strong class="text-base">Designation:</strong><i class="col-span-2"><?= $details->designation ?></i>
                                                  <strong class="text-base">End User:</strong><i class="col-span-2"><?= $details->endUser ?></i>

                                                  <?php if (!empty($details->currentLocation)) : ?>
                                                            <strong class="text-lg">Current Location:</strong><span class="col-span-2 text-base font-semibold underline text-blue-400"><?= $details->currentLocation ?></span>
                                                  <?php endif ?>
                                        </div>
                                        <span class="text-xs float-end">Encoded by: <i class=""><?= $details->encoder ?></i></span>
                              </div>
                              <div class="flex text-white gap-x-2">
                                        <?php if (!empty($details->currentLocation)) { ?>

                                                  <button data-modal-target="returnItemModal" data-modal-toggle="returnItemModal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                            <i class="fa-solid fa-undo"></i> Return
                                                  </button>
                                                  <?php $this->view("components/item_return_modal", ["details" => $details, "csrfToken" => $csrfToken, "activeTransaction" => $activeTransaction]) ?>
                                        <?php } else if ($details->inHouse) {  ?>
                                                  <button type="button" data-drawer-target="pullOutForm" data-drawer-show="pullOutForm" data-drawer-placement="right" aria-controls="pullOutForm" class="bg-yellow-700 hover:bg-yellow-800 focus:ring-1 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2 focus:outline-none" type="button" data-drawer-target="pullOutForm" data-drawer-show="pullOutForm" data-drawer-placement="right" aria-controls="pullOutForm">
                                                            <i class="fa-solid fa-arrows-turn-right"></i> Pull out
                                                  </button>
                                                  <?php $this->view("components/item_pullout_drawer", ["details" => $details, "csrfToken" => $csrfToken]) ?>
                                        <?php } ?>

                                        <button id="manageDropdown" data-dropdown-toggle="dropdown" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800" type="button">Manage
                                                  <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                                  </svg>
                                        </button>

                                        <!-- Dropdown menu -->
                                        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                                  <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="manageDropdown">
                                                            <li>

                                                                      <div class="block px-4 py-2 hover:bg-gray-600 hover:text-white" type="button" data-drawer-target="itemUpdate" data-drawer-show="itemUpdate" data-drawer-placement="right" aria-controls="itemUpdate">Update</div>
                                                            </li>
                                                            <li>
                                                                      <div data-modal-target="itemDeleteModal" data-modal-toggle="itemDeleteModal" class="block px-4 py-2 hover:bg-gray-600 hover:text-white" type="button">
                                                                                Delete
                                                                      </div>
                                                            </li>
                                                  </ul>
                                        </div>
                              </div>
                    </div>
                    <div class="relative">
                              <div class="overflow-auto max-h-[80vh] rounded-xl p-5 border-2 my-2 text-xs shadow-xl text-white bg-gray-700">
                                        <table class="w-full">
                                                  <thead>
                                                            <tr class="border-b-4 border-gray-500">
                                                                      <th class="pb-2">
                                                                                <h3 class="text-xl text-start font-bold tracking-wide">Transactions</h3>
                                                                      </th>
                                                            </tr>
                                                  </thead>
                                                  <tbody>
                                                            <?php
                                                            if (!empty($transactions)) :
                                                                      foreach ($transactions as $transaction) : ?>
                                                                                <tr>
                                                                                          <td class="border-b border-gray-500">
                                                                                                    <a href="<?= ROOT ?>inventory/transaction/<?= $transaction->transactionId ?>">
                                                                                                              <div class="hover:bg-gray-600 min-h-16 p-3 space-y-1 rounded" data-drawer-target="transactionDetails" data-drawer-show="transactionDetails" data-drawer-placement="right" aria-controls="transactionDetails" type="button" data-drawer-target="transactionDetails" data-drawer-show="transactionDetails" data-drawer-placement="right" aria-controls="transactionDetails">
                                                                                                                        <?php if ($transaction->status) : ?> <p class="text-green-500 italic"><i class="fa-solid fa-circle-dot animate-pulse"></i> Active</p> <?php endif; ?>
                                                                                                                        <span class="text-xs float-end"><?= formatDate($transaction->pullOutDate) ?></span>
                                                                                                                        <p class="text-base"><?= $transaction->fromLocation ?> - <?= $transaction->toLocation ?></p>
                                                                                                                        <span class="mx-2"><?= $transaction->pullOutType ?></span>
                                                                                                                        <?php if (!empty($transaction->returnDate) && $transaction->pullOutType == "Temporary") : ?>
                                                                                                                                  <p>
                                                                                                                                            <span class="font-semibold text-yellow-600">Expected/Returned: </span><span><?= formatDate($transaction->returnDate) ?></span>
                                                                                                                                            <?php if (!empty($transaction->returnedDate)) : ?> <span>/ <?= formatDate($transaction->returnedDate) ?></span> <?php endif; ?></span>
                                                                                                                                  </p>
                                                                                                                        <?php endif; ?>
                                                                                                              </div>
                                                                                                    </a>
                                                                                          </td>
                                                                                </tr>
                                                                      <?php endforeach;
                                                            else : ?>
                                                                      <tr>
                                                                                <td class=" border-b border-gray-500">
                                                                                          <div class="hover:bg-gray-400 h-16 p-3 rounded">
                                                                                                    <i class="text-base">No transactions found yet</p>
                                                                                          </div>
                                                                                </td>
                                                                      </tr>
                                                            <?php endif ?>
                                                  </tbody>
                                        </table>
                              </div>
                    </div>
          </div>
</div>
<?php $this->view("components/item_update_drawer", ["details" => $details, "csrfToken" => $csrfToken]) ?>
<?php $this->view("components/item_deleteconfirm_modal", ["details" => $details, "csrfToken" => $csrfToken]) ?>
<script src="<?= JS ?>items.js"></script>
<?php $this->view("includes/footer") ?>