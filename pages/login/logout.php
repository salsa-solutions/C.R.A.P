<?php
session_start();
require_once('/var/www/html/config.php');
require_once('/var/www/html/pages/page-index.php');

if (!isset($_SESSION['name']) || !isset($_SESSION['username']) || !isset($_SESSION['role']) || !isset($_SESSION['role_name']) || !isset($_SESSION['uid'])) {
    header('Location: ' . $login_page_url . '');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION);
    header("Location: $login_page");
}
?>