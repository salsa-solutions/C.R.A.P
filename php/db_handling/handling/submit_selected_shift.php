<?php
require_once('/var/www/html/config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('/var/www/html/config.php');
$pdo = $db;



?>

<?php
$currentDate = new DateTime();

if (isset($_POST)) {
    $uuid              = $_POST['uuid'];
    $status            = $_POST['status'];
    $date              = $currentDate->format('Y-m-d H:i:s');
    $name              = $_POST['name'];
    $username          = $_POST['username'];
    $day_id            = $_POST['day_id'];
}

?>