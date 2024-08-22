<?php $this->view("includes/header") ?>
<?php $this->view("components/inventory_add_drawer", ["csrfToken" => $csrfToken]) ?>
<div class="inventory container space-y-2 my-2">
        <?php $this->view("components/inventory_table") ?>
        <div class="w-[300px] space-y-3">
                <h3 class="font-bold text-xl my-3">Asset Types</h3>
                <form id="newAssetForm" method="post" class="inline-flex gap-2">
                        <input type="hidden" name="csrfToken" value="<?= escape($csrfToken); ?>">
                        <input class="soft-input" type="text" id="assetField" name="asset" placeholder="Asset Name">
                        <button type="submit" disabled id="newAssetSubmitBtn" class="bg-blue-700 btn-primary text-center inline-flex justify-center items-center"><i class="fa fa-plus me-2"></i> Create</button>
                </form>
                <div class="h-[200px] overflow-y-auto text-sm rounded shadow" style="height: 500px; overflow: auto">
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
</div>
<script src="<?= JS ?>inventory/itemAssets.js"></script>
<script src="<?= JS ?>inventory/inventoryTable.js"></script>
<?php $this->view("includes/footer") ?>