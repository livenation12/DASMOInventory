<?php $this->view("includes/header") ?>
<div class="max-w-full flex justify-center items-start min-h-screen bg-blue-950">
    <div class="shadow rounded-xl login-wrapper md:w-3/5 lg:w-2/5 flex flex-col mt-6 md:mt-16 lg:mt-10 justify-center items-center bg-white">
        <div class="w-full rounded-t-lg h-16 flex justify-center items-center text-2xl text-white font-semibold bg-blue-600">
            DASMO INVENTORY LOGIN
        </div>
        <div class="w-full flex justify-center items-center">
            <img src="<?= ROOT ?>assets/icon.png" width="140px" alt="DASMO">
        </div>
    
        <form method="post" id="loginForm" class="flex flex-col gap-3 w-full p-6">
            <input type="hidden" name="csrfToken" value="<?= escape($csrfToken); ?>">
            <div class="relative inline-block">
                <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                <input type="text" name="username" id="username" value="<?= escape(getVar('username')) ?>" class="password bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-500 dark:placeholder-gray-400" required />
            </div>
            <div class="relative inline-block">
                <label for="passwordInput" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                <i class="fa-regular fa-eye absolute right-4 bottom-3 text-black/40 cursor-pointer" id="togglePassword" onclick="toggleShowPassword('passwordInput', 'togglePassword')"></i>
                <input type="password" name="password" id="passwordInput" class="password bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-500 dark:placeholder-gray-400" required />
            </div>
            <a class="hover:underline self-end m-2 text-sm text-gray-400" href="<?= ROOT ?>forgot">Forgot password?</a>
            <button class="shadow rounded bg-blue-800 text-white h-10 w-full" name="login" type="submit">Login</button>
            <a href="<?= ROOT ?>signup" class="hover:underline m-2 text-sm text-gray-400">Don't have an account? <span class="text-blue-800">Signup</span"></a>
        </form>
    </div>
</div>
<script src="<?= JS ?>user/login.js"></script>
<script src="<?= JS ?>togglePassword.js"></script>
<?php $this->view("includes/footer") ?>
