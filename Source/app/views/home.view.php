<?php $this->view("includes/header"); ?>
<section class="my-2">
          <div class="grid lg:grid-cols-4 gap-y-2">
                    <div class="col-span-3">
                              <div class="grid grid-cols-3">
                                        <a href="<?= ROOT ?>inventory" class="hover:bg-yellow-600/90 text-white rounded bg-yellow-600 p-3 font-semibold shadow-2xl">
                                                  <p class="text-end text-6xl mx-3"><?= $currentBorrowedItems ?></p>
                                                  <p class="text-muted-foreground">Active borrowed items </p>
                                        </a>
                              </div>
                    </div>
                    <div class="activity-logs wrapper bg-slate-500 text-white p-3 rounded">
                              <?php $this->view("components/activitylogs_table") ?>
                    </div>
          </div>
</section>
<?php $this->view("includes/footer") ?>




<?php if (isset($_SESSION["login_success"])) : ?>
          <script>
                    Swal.fire({
                              icon: 'success',
                              title: 'Login Successful',
                              text: 'Welcome back!',
                              showConfirmButton: false,
                              timer: 1000
                    }).then(() => {
                              <?php unset($_SESSION['login_success']);
                              ?>
                    });
          </script>
<?php endif; ?>