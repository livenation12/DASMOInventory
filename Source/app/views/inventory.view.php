<?php $this->view("includes/header") ?>
<?php $this->view("components/inventory_add_drawer", ["csrfToken" => $csrfToken]) ?>
<div class="inventory container space-y-2 my-2">
          <div class="">
                    <div class="flex justify-between">
                              <h3 class="text-3xl font-bold">Inventory Masterlist</h3>
                              <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-1 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 focus:outline-none" type="button" data-drawer-target="newItemForm" data-drawer-show="newItemForm" data-drawer-placement="right" aria-controls="newItemForm">
                                        New
                              </button>
                    </div>
                    <div class="relative overflow-x-auto rounded-xl p-5 border-2 my-2 text-xs shadow-xl text-white bg-gray-700">
                              <?= $this->view("components/inventory_masterlist_table") ?>
                    </div>
          </div>
</div>


<?php $this->view("includes/footer") ?>

<script src="<?= JS ?>inventory.js"></script>