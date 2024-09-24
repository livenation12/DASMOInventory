<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="HTML, CSS, JavaScript">
        <link rel="icon" type="image/x-icon" href="<?= ASSETS ?>icon.png">

        <!-- local style files -->
        <link rel="stylesheet" href="<?= LIB ?>all.min.css">
        <link rel="stylesheet" href="<?= LIB ?>datatables.min.css">
        <link href="<?= CSS ?>styles.css" rel="stylesheet">
        <link href="<?= CSS ?>input.css" rel="stylesheet">

        <!-- cdn links -->
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
        <!-- Local scripts -->
        <script src="<?= JS ?>main.js" defer></script>
        <script src="<?= LIB ?>datatables.min.js"></script>
        <title><?= ucfirst(getActiveTab()) ?></title>
</head>

<body class="bg-gray-300 max-w-[100vw]">

        <?php
        if (Auth::isLogin()) :
                $this->view("includes/sidenav"); ?>
                <div class="xl:ml-[320px]">
                        <main class="min-h-screen mx-5 mt-2">
                        <?php $this->view("includes/topnav");
                endif;
                        ?>