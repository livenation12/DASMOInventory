<?php $this->view("includes/header"); ?>

<div class="grid grid-cols-3 gap-3 mb-10">
    <div class="col-span-2">
        <div class="grid grid-cols-3 gap-3">
            <div class="p-3 text-yellow-500 font-semibold border rounded shadow-xl">
                <p class="text-end text-6xl mx-3"><?= $currentBorrowedItems ?></p>
                <p class="text-muted-foreground"># Borrowed items </p>
            </div>
            <div class="p-3 text-blue-600 font-semibold border rounded shadow-xl">
                <p class="text-end text-6xl mx-3"><?= $availableItemsCount ?></p>
                <p class="text-muted-foreground"># Available Items </p>
            </div>
        </div>
        <?php include(viewComponent("weekly_chart")) ?>
        <section>
            <div class="shadow-xl border rounded p-3">
                <p class="text-lg font-semibold">Filters</p>
                <div class="flex gap-2">
                    <div>
                        <label for="assetType" class="soft-label">Asset type</label>
                        <select id="assetType" name="assetType" class="soft-select w-48">
                            <option selected value="">Loading...</option>
                        </select>
                    </div>
                    <div>
                        <label for="date" class="soft-label">Date</label>
                        <input type="date" id="date" name="date" class="soft-input w-48">
                    </div>

                </div>

                <canvas id="assetsChart" height="100"></canvas>
            </div>
        </section>
    </div>
    <?php $this->view("components/activitylogs_table") ?>
</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?= JS ?>charts/assets.js" defer></script>
<script src="<?= JS ?>items/assetTypes.js" defer></script>
<?php $this->view("includes/footer") ?>