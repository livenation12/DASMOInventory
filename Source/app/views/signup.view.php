<?php $this->view("includes/header") ?>
<div class="max-w-full flex justify-center items-start min-h-screen bg-blue-950">
    <div class="shadow login-wrapper md:w-3/5 lg:w-2/5 flex flex-col mt-6 md:mt-16 lg:mt-10 justify-center items-center bg-white">
        <div class="w-full h-16 flex justify-center items-center text-2xl text-white font-semibold bg-blue-600">
            DASMO INVENTORY SIGNUP
        </div>
        <div class="w-full flex justify-center items-center">
            <img src="<?= ROOT ?>assets/icon.png" width="140px" alt="DASMO">
        </div>
        <form id="signupForm" method="post" class="flex flex-col gap-3 w-full p-6">
            <input type="hidden" name="csrfToken" value="<?= escape($csrfToken); ?>">

            <div class="relative inline-block">
                <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900">Firstname</label>
                <input type="text" name="firstname" id="firstname" class="password bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            </div>

            <div class="relative inline-block">
                <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900">Lastname</label>
                <input type="text" name="lastname" id="lastname" class="password bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            </div>
            <div class="relative inline-block">
                <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                <input type="text" name="username" id="username" class="password bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            </div>
            <div class="relative inline-block">
                <label for="passwordInput" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                <i class="fa-regular fa-eye absolute right-4 bottom-3 text-black/40 cursor-pointer" id="togglePassword" onclick="toggleShowPassword('passwordInput', 'togglePassword')"></i>
                <input type="password" name="password" id="passwordInput" class="password bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            </div>
            <div class="relative inline-block">
                <label for="confirmPassword" class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
                <i class="fa-regular fa-eye absolute right-4 bottom-3 text-black/40 cursor-pointer" id="toggleConfirmPassword" onclick="toggleShowPassword('confirmPassword', 'toggleConfirmPassword')"></i>
                <input type="password" name="cpassword" id="confirmPassword" class="password bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            </div>
            <button class="shadow bg-blue-800 text-white h-10 w-full" type="submit">Signup</button>
            <a href="<?= ROOT ?>login" class="hover:underline self-end m-2 text-sm text-gray-400">Already have an account?</a>
        </form>
    </div>
</div>

<?php $this->view("includes/footer") ?>
<script src="<?= JS ?>user/signup.js"></script>
<script src="<?= JS ?>togglePassword.js"></script>