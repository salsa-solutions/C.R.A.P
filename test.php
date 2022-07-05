<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['userlogin'])) {
	header("Location: login.php");
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION);
	header("Location: login.php");
}
echo $_SESSION['userlogin'];
?>