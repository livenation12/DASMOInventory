<?php $this->view("includes/header") ?>
<?php $this->view("components/inventory_add_drawer", ["csrfToken" => $csrfToken]) ?>
<div class="mt-2">
          <div class="flex justify-between items-center mb-1">
                    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
                              <li class="me-2">
                                        <a href="#" aria-current="page" class="inline-block p-4 text-blue-600 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500">Masterlist</a>
                              </li>
                              <li class="me-2">
                                        <a href="#" class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">Borrowed</a>
                              </li>
                    </ul>
                    <div class="ml-auto">
                              <button class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-1 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 focus:outline-none" type="button" data-drawer-target="newItemForm" data-drawer-show="newItemForm" data-drawer-placement="right" aria-controls="newItemForm">
                                        New
                              </button>
                    </div>
          </div>
          <div class="relative overflow-x-auto rounded-xl p-5 border-2 my-2 text-xs shadow-xl text-white bg-gray-700">
                    <table id="inventoryTable" class="w-full text-left rtl:text-right">
                              <thead class="text-sm capitalize">
                                        <tr>
                                                  <th>Quantity</th>
                                                  <th>Description</th>
                                                  <th>Property Number</th>
                                                  <th>Serial Number</th>
                                                  <th>Designation / Current Location</th>
                                                  <th></th>
                                        </tr>
                              </thead>
                              <tbody class="text-sm">
                                        <!-- Data will be injected here by DataTable -->
                              </tbody>
                    </table>
          </div>
</div>


<?php $this->view("includes/footer") ?>

<script src="<?= JS ?>inventory.js"></script>