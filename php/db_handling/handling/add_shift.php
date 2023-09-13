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

// $position = "test";

if (isset($_POST)) {

    $date              = $currentDate->format('Y-m-d');
    $uuid              = isset($_POST['uuid']) ? $_POST['uuid'] : '';
    $name              = isset($_POST['name']) ? $_POST['name'] : '';
    $username          = isset($_POST['username']) ? $_POST['username'] : '';
    $start_time        = isset($_POST['start_time']) ? $_POST['start_time'] : '';
    $end_time          = isset($_POST['end_time']) ? $_POST['end_time'] : '';
    $max_employees      = isset($_POST['max_employees']) ? $_POST['max_employees'] : '';
    $position         = isset($_POST['position']) ? $_POST['position'] : '';
    $week              = getCurrentWorkWeek();
    $day               = isset($_POST['day_of_week']) ? $_POST['day_of_week'] : '';

    // Check if the variables are empty before echoing
    if (!empty($uuid) && !empty($name) && !empty($username) && !empty($start_time) && !empty($end_time) && !empty($max_employees) && !empty($position) && !empty($week) && !empty($day)) {
        $sql = "INSERT INTO shifts (uuid, date, name, username, start_time, end_time, max_employees, position, week, day_of_week)
        VALUES (:uuid, :date, :name, :username, :start_time, :end_time, :max_employees, :position, :week, :day_of_week)";
        $stmt = $db->prepare($sql);

        // Bind the variables to the placeholders
        $stmt->bindParam(':uuid', $uuid);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':start_time', $start_time);
        $stmt->bindParam(':end_time', $end_time);
        $stmt->bindParam(':max_employees', $max_employees);
        $stmt->bindParam(':position', $position);
        $stmt->bindParam(':week', $week);
        $stmt->bindParam(':day_of_week', $day);

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
}

?>

