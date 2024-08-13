<?php $this->view("includes/header") ?>
<?php $this->view("components/inventory_add_drawer", ["csrfToken" => $csrfToken]) ?>
<div class="mt-2">
          <div class="text-end">
                    <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-1 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 focus:outline-none" type="button" data-drawer-target="newItemForm" data-drawer-show="newItemForm" data-drawer-placement="right" aria-controls="newItemForm">
                              New
                    </button>
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