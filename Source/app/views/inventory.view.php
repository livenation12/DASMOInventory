<?php $this->view("includes/header") ?>
<?php $this->view("components/inventory_add_drawer", ["csrfToken" => $csrfToken]) ?>
<div class="inventory container space-y-2 my-2">
        <div class="flex justify-between">
                <h3 class="text-3xl font-bold">Inventory Masterlist</h3>
                <button class="btn-primary" data-drawer-target="newItemForm" data-drawer-show="newItemForm" data-drawer-placement="right" aria-controls="newItemForm">
                        New Item
                </button>
        </div>
        <div class="grid grid-cols-4 gap-x-2">
                <div class="col-span-3">
                        <?php $this->view("components/inventory_table") ?>
                </div>
                <section>
                        <div class="space-y-3 rounded border shadow-xl p-3">
                                <h3 class="font-bold text-xl my-3">Asset Types</h3>
                                <form id="newAssetForm" method="post" class="inline-flex gap-2">
                                        <input type="hidden" name="csrfToken" value="<?= escape($csrfToken); ?>">
                                        <input class="soft-input" type="text" id="assetField" name="asset" placeholder="Asset Name">
                                        <button type="submit" disabled id="newAssetSubmitBtn" class="bg-blue-700 btn-primary text-center inline-flex justify-center items-center"><i class="fa fa-plus me-2"></i> Create</button>
                                </form>
                                <div class="overflow-y-auto text-sm" style="max-height: 500px; overflow: auto">
                                        <table id="assetTypeTable" class="datatable ">
                                                <thead>
                                                        <tr>
                                                                <th>
                                                                        <h3 class="font-semibold text-lg">List</h3>
                                                                </th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        <!-- Add more rows here to test scrolling -->
                                                </tbody>
                                        </table>
                                </div>
                        </div>
                </section>
        </div>
</div>
<script src="<?= JS ?>inventory/itemAssets.js"></script>
<script src="<?= JS ?>inventory/inventoryTable.js"></script>
<?php $this->view("includes/footer") ?>