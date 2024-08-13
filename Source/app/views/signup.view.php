<?php $this->view("includes/header") ?>
<div class="max-w-full flex justify-center items-start min-h-screen bg-blue-950">
    <div class="shadow login-wrapper w-full md:w-3/5 lg:w-2/5 flex flex-col mt-6 md:mt-16 lg:mt-10 justify-center items-center bg-white">
        <div class="w-full h-16 flex justify-center items-center text-2xl text-white font-semibold bg-blue-600">
            DASMO INVENTORY SIGNUP
        </div>
        <div class="w-full flex justify-center items-center">
            <img src="<?= ROOT ?>assets/icon.png" width="140px" alt="DASMO">
        </div>
        <div class="flex flex-col gap-y-2 w-full px-4">
            <?php
            if (!empty($errors)) {
                foreach ($errors as $error) { ?>
                    <div class="rounded text-yellow-500 p-3">
                        <i class="fa-solid fa-circle-exclamation"></i> <?= $error ?>
                    </div>
            <?php  }
            } ?>
        </div>
        <form method="post" class="flex flex-col gap-3 w-full p-6">
            <input type="hidden" name="csrfToken" value="<?= escape($csrfToken); ?>">
            <input name="firstname" value="<?= getVar('firstname') ?>" class="shadow h-10 p-3 focus:outline-none focus:ring focus:ring-blue-400" placeholder="Firstname">
            <input name="lastname" value="<?= getVar('lastname') ?>" class="shadow h-10 p-3 focus:outline-none focus:ring focus:ring-blue-400" placeholder="Lastname">
            <input name="username" value="<?= getVar('lastname') ?>" class="shadow h-10 p-3 focus:outline-none focus:ring focus:ring-blue-400" placeholder="Username">
            <div class="relative inline-block">
                <input type="password" id="passwordInput" name="password" class="password shadow h-10 w-full p-3 focus:outline-none focus:ring focus:ring-blue-400" placeholder="Password">
                <i class="fa-regular fa-eye absolute right-3 top-3 text-black/40 cursor-pointer" id="togglePassword" onclick="toggleShowPassword('passwordInput', 'togglePassword')"></i>
            </div>
            <div class="relative inline-block">
                <input type="password" id="confirmPasswordInput" name="cpassword" class="password shadow h-10 w-full p-3 focus:outline-none focus:ring focus:ring-blue-400" placeholder="Confirm Password">
                <i class="fa-regular fa-eye absolute right-3 top-3 text-black/40 cursor-pointer" id="toggleConfirmPassword" onclick="toggleShowPassword('confirmPasswordInput', 'toggleConfirmPassword')"></i>
            </div>

            <button class="shadow bg-blue-800 text-white h-10 w-full" type="submit">Signup</button>
            <a href="<?= ROOT ?>login" class="hover:underline self-end m-2 text-sm text-gray-400">Already have an account?</a>
        </form>
    </div>
</div>

<?php $this->view("includes/footer") ?>
<script src="<?= JS ?>togglePassword.js"></script>