<?php

require "config.php";
require "helpers.php";
require "database.php";
require "app.php";
require "controller.php";
require "model.php";

spl_autoload_register(function ($className) {
        require "../app/models/" . ucfirst($className) . ".model.php";
});
