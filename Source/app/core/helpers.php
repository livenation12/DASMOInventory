<?php

function getVar($key, $default = '')
{
        if (isset($_POST[$key])) {
                return $_POST[$key];
        }
        return $default;
}

function getSelected($key, $value, $default = "")
{
        if (isset($_POST[$key])) {
                if ($_POST[$key] == $value) {
                        return "selected";
                }
        } elseif ($default == $value) {
                return "selected";
        }
        return "";
}


function escape($var)
{
        return htmlspecialchars($var);
}


function randomString($length)
{
        $lowercaseLetters = range('a', 'z');
        $uppercaseLetters = range('A', 'Z');
        $numbers = range(0, 9);
        $combined = array_merge($lowercaseLetters, $uppercaseLetters, $numbers);
        $text = "";
        for ($i = 0; $i < $length; $i++) {
                $randomize = rand(0, 61);
                $text .= $combined[$randomize];
        }
        return $text;
}

function formatDate($date)
{
        if(!empty($date)){
                return date("M j, Y hA", strtotime($date));
        }
        return "";
       
}

function show($data)
{
        echo "<pre class='z-50'>";
        print_r($data);
        echo "</pre>";
}

function activeTab($page_tab, $tab)
{
        return $page_tab === $tab ? 'active' : '';
}

function viewPath($view)
{
        if (file_exists("../app/views/includes/" . $view . ".inc.php")) {
                return ("../app/views/includes/" . $view . ".inc.php");
        } else {
                return ("../app/views/404.view.php");
        }
}

function getActiveTab()
{
       return App::getURL()[0];
}
