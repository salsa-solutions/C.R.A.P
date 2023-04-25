<?php
require_once('/var/www/html/config.php');
require_once('/var/www/html/php/functions/time.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<?php
$currentDate = new DateTime();

session_start();
if (isset($_POST)) {

    $date              = $currentDate->format('Y-m-d');
    $uuid              = $_POST['created_by_uuid'];
    $created_by        = $_POST['created_by'];
    $role_name         = $_POST['role_name'];
    $role              = $_POST['role'];
    $role_description  = $_POST['role_description'];

    // $date             = $currentDate->format('Y-m-d');
    // $uuid             = '123e4567-e89b-12d3-a456-426655440000';
    // $created_by       = 'john.doe';
    // $role_name        = 'Manager';
    // $role             = 'Manager';
    // $role_description = 'Manager';

    // check if var is empty
    if (empty($uuid) || empty($created_by) || empty($role_name) || empty($role) || empty($role_description)) {
        echo 300;
        exit();
    }


    $sql = "INSERT INTO roles (role_name, role_description, created_by_uuid, created_date, created_by, role) VALUES (:role_name, :role_description, :created_by_uuid, :created_date, :created_by, :role)";
    $stmt = $db->prepare($sql);
    

    // Bind the variables to the placeholders
    $stmt->bindParam(':role_name', $role_name);
    $stmt->bindParam(':role_description', $role_description);
    $stmt->bindParam(':created_by_uuid', $uuid);
    $stmt->bindParam(':created_date', $date);
    $stmt->bindParam(':created_by', $created_by);
    $stmt->bindParam(':role', $role);


    $result = $stmt->execute();

    if ($result) {
        echo 100;
        exit();
    } else {
        echo 200;
        exit();
    }
} else {
    echo 300;
    exit();
}
?>