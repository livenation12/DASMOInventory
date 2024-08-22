<?php $this->view("includes/header"); ?>
<!-- <?= show($transactions)?> -->
<section class="my-2">
    <div class="grid lg:grid-cols-4 gap-3">
        <div class="col-span-3 space-y-3">
            <div class="grid grid-cols-3 gap-3">
                <a href="<?= ROOT ?>inventory" class="p-3 text-yellow-500 font-semibold rounded shadow">
                    <p class="text-end text-6xl mx-3"><?= $currentBorrowedItems ?></p>
                    <p class="text-muted-foreground"># Borrowed items </p>
                </a>
                <a href="<?= ROOT ?>inventory" class="p-3 text-blue-600 font-semibold rounded shadow">
                    <p class="text-end text-6xl mx-3"><?= $availableItemsCount ?></p>
                    <p class="text-muted-foreground"># Available Items </p>
                </a>
            </div>
            <div class="shadow p-3">
                <canvas id="weeklyReportChart" height="100"></canvas>
            </div>
        </div>
            <?php $this->view("components/activitylogs_table") ?>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?= JS ?>charts/weekly.js" defer></script>
<?php $this->view("includes/footer") ?>