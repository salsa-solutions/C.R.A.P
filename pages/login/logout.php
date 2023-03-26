<?php
session_start();
require_once('/var/www/html/config.php');
require_once('/var/www/html/pages/page-index.php');

if (!isset($_SESSION['userlogin'])) {
    header("Location: login.php");
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION);
    header("Location: $login_page");
}
?>