<?php

############################## UTILS ###############################

function dd($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

function requireView($filename)
{
    if (file_exists('views/' . $filename . '-' . $_SESSION['style'] . '.view.php')) {
        require 'views/' . $filename . '-' . $_SESSION['style'] . '.view.php';
    } else {
        require 'views/' . $filename . '.view.php';
    }
}
