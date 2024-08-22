<nav class="block w-full max-w-full bg-transparent text-white shadow-none rounded-xl transition-all px-0 py-1">
    <div class="flex flex-col-reverse justify-between gap-6 md:flex-row md:items-center">
        <div class="capitalize">
            <nav aria-label="breadcrumb" class="w-max">
                <ol class="flex flex-wrap items-center w-full bg-opacity-60 rounded-md bg-transparent p-0 transition-all">
                    <?php foreach (App::getURL() as $url) : ?>
                        <li class="flex items-center text-blue-gray-900 antialiased font-sans text-sm font-normal leading-normal cursor-pointer transition-colors duration-300 hover:text-light-blue-500">
                            <a href="#">
                                <p class="block antialiased font-sans text-sm leading-normal text-blue-900 font-normal opacity-50 transition-all hover:text-blue-500 hover:opacity-100"><?= $url ?></p>
                            </a>
                            <span class="text-gray-500 text-sm antialiased font-sans font-normal leading-normal mx-2 pointer-events-none select-none">/</span>
                        </li>
                    <?php endforeach; ?>

                </ol>
            </nav>

        </div>
        <div class="flex items-center">



            <!-- dropdown trigger -->
            <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" type="button">
                <div class="relative inline-flex items-center justify-center size-7 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                    <span class="font-medium text-gray-600 dark:text-gray-300">
                        <?= Auth::getFullname()[0] ?>
                    </span>
                </div>
            </button>

            <!-- Dropdown menu -->
            <div id="dropdownAvatar" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                    <div><?= Auth::getFullname(); ?>
                    </div>

                </div>
                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownUserAvatarButton">
                    <li>
                        <a href="<?= ROOT ?>home" class="block px-4 py-2 hover:bg-white text-black">Dashboard</a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>inventory" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Inventory</a>
                    </li>

                </ul>
                <div class="py-2">
                    <button id="signout" class="block px-4 py-2 text-sm hover:bg-gray-100 w-full text-start text-black">Signout</button>
                </div>
            </div>
        </div>
    </div>
</nav>

<script src="<?=JS?>signout.js" defer></script>