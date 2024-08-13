<?php $this->view("includes/header"); ?>

<a href="<?= ROOT ?>inventory/items/<?= $transactionDetails->itemId ?>"><i class="fa-solid fa-arrow-left ms-2 my-2"></i>
          <strong class="text-xl font-bold tracking-wide ms-2">Transaction Details</strong>
</a>
<div class=" <?= ($transactionDetails->pullOutType === "Temporary") ? "bg-yellow-950" : "bg-slate-700" ?> rounded-lg p-4 text-white md:w-2/3 mt-3">
          <?php if ($transactionDetails->status === "active") : ?> <p class="text-green-500 italic"><i class="fa-solid fa-circle-dot animate-pulse"></i> Active</p> <?php endif; ?>

          <div class="grid grid-cols-2 md:grid-cols-4 my-5">
                    <strong class="">Puller name:</strong>
                    <i class="text-sm"><?= $transactionDetails->puller ?></i>
                    <strong class="">From-To:</strong>
                    <i class="text-sm"><?= $transactionDetails->fromLocation ?> - <?= $transactionDetails->toLocation ?></i>
                    <strong class="">Type:</strong>
                    <i class="text-sm"><?= $transactionDetails->pullOutType ?></i>
                    <strong class="">Pullout date:</strong>
                    <i class="text-sm"><?= $transactionDetails->pullOutDate ?></i>
                    <strong class="">Approved by:</strong>
                    <i class="text-sm"><?= $transactionDetails->approverName ?></i>
                    <?php if ($transactionDetails->returnDate) : ?>
                              <strong class="">Expected return date:</strong>
                              <i class="text-sm"><?= $transactionDetails->returnDate ?></i>
                    <?php endif ?>
                    <?php if ($transactionDetails->returnedDate) : ?>
                              <strong class="">Actual returned date:</strong>
                              <i class="text-sm"><?= $transactionDetails->returnedDate ?></i>
                    <?php endif ?>
                    <?php if ($transactionDetails->receiverId) : ?>
                              <strong class="">Received by:</strong>
                              <i class="text-sm"><?= $transactionDetails->receiverName ?></i>
                    <?php endif ?>
          </div>
</div>

<?php $this->view("includes/footer"); ?>