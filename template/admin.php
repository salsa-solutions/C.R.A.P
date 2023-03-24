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
if ( ($role == 'Admin') || ($role == 'Manager')) {
    $managment = 'Management';
    $Admin_page='<a href="/admin.php">Admin</a>';
    $scheduling_page='<a href="/scheduling.php">Scheduling</a>';
	$approval = '<a href="/approval.php">Approval</a>';
}
else {
    $managment = NULL;
    $Admin_page= NULL;
    $scheduling_page= NULL;
    $approval = NULL;
}
if ( ($role == 'Admin')) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

}elseif ($role == 'Manager'){

}


else {
    header("Location: index.php");
}

?>


<?php if (($_DEV) && (($role == 'Server') || ($role == 'Manager') || ($role == 'Cook')) == '1') {
    echo $out_of_service;
}elseif(($role == 'Server')){
    echo $fourohthree;
}elseif(($status == 'approved')){
    echo $pending;
}
?>

<!-- content -->

<?php
echo $footer

?>