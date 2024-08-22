<?php $this->view("includes/header"); ?>
<div class="inventory container space-y-2 my-2">
    <div class="">
            <?php $this->view("components/transactions_table") ?>
    </div>
</div>

<script src="<?= JS ?>transactions.js"></script>
<?php $this->view("includes/footer"); ?>