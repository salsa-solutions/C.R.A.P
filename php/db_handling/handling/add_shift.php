<?php
require_once('/var/www/html/config.php');
require_once('/var/www/html/php/functions/time.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<?php
$currentDate = new DateTime();

// $day = "tusday";
$week = getCurrentWorkWeek();
// $role_name = "test";

if (isset($_POST)) {
 
    $date              = $currentDate->format('Y-m-d');
    $uuid              = $_POST['uuid'];
    $name              = $_POST['name'];
    $username          = $_POST['username'];
    $start_time        = $_POST['start_time'];
    $end_time          = $_POST['end_time'];
    $employee_max      = $_POST['employee_max'];
    $role_name         = $_POST['role_name'];
    $week              = getCurrentWorkWeek();
    $day               = $_POST['day'];
    if (empty($uuid) || empty($name) || empty($username) || empty($start_time) || empty($end_time) || empty($employee_max) || empty($role_name) || empty($week) || empty($day)) {
        echo 300;
        exit();
    }

    echo $week;
    // check if var is empty

    // $uuid = "123e4567-e89b-12d3-a456-426655440000";
    // $date = "2023-04-23";
    // $name = "Shift A";
    // $username = "john.doe";
    // $start_time = "08:00 AM";
    // $end_time = "3:00 PM";
    // $employee_max = 10;
    // $role_name = "Manager";
    // $week              = strval($week);
    // $day = "Saturday";

    $sql = "INSERT INTO shifts (uuid, date, name, username, start_time, end_time, employee_max, role_name, week, day)
        VALUES (:uuid, :date, :name, :username, :start_time, :end_time, :employee_max, :role_name, :week, :day)";
    $stmt = $db->prepare($sql);

    // Bind the variables to the placeholders
    $stmt->bindParam(':uuid', $uuid);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':start_time', $start_time);
    $stmt->bindParam(':end_time', $end_time);
    $stmt->bindParam(':employee_max', $employee_max);
    $stmt->bindParam(':role_name', $role_name);
    $stmt->bindParam(':week', $week);
    $stmt->bindParam(':day', $day);

    $result = $stmt->execute();
    
    if ($result) {
        echo 100;
        // exit();
    } else {
        echo 200;
        exit();
    }
} else {
    echo 300;
    exit();
}
?>