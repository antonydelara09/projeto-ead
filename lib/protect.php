<?php
if (!function_exists("protect")) {
    function protect($admin)
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            //var_dump($admin);
            die("<script>location.href='login.php';</script>");
            //header("Location: login.php");

        }

        if ($admin == 1 && $_SESSION['administrator'] != 1) {
            //var_dump($admin);
            die("<script>location.href='login.php';</script>");
            //header("Location: login.php");

        }
    }
}