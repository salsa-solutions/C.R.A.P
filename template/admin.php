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
$name = $_SESSION['userlogin'][0];
$role = $_SESSION['userlogin'][1];
$username = $_SESSION['userlogin'][2];
$WEB_TITLE = 'Admin';
$_DEV = false;
if ( ($role == 'admin') || ($role == 'manager')) {
    $admin_page='<li><a href="/admin.php">Admin</a></li>';
    $scheduling_page='<li><a href="/scheduling.php">Scheduling</a></li>';
}
else {
    $admin_page= NULL;
    $scheduling_page= NULL;
}
if ( ($role == 'admin')) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

}elseif ($role == 'manager'){

}


else {
    header("Location: index.php");
}

?>

<?php
include_once('php/template.php');

echo $header;
?>

<!-- content -->

<?php
echo $footer

?>