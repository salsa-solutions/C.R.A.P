<?php 
// $string = "test";
// only show the first 2 characters
// echo substr($string, 0, 2);
// echo $string[];

// show error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '/var/www/html/config.php';
$pdo = $db;
// Assuming you have already connected to the SQL database

function insertPendingShifts($uuid, $approved, $date, $name, $username, $dayIdArray, $pdo)
{
    // Prepare a statement to insert into pending_shifts table
    $stmt = $pdo->prepare("INSERT INTO pending_shifts (uuid, approved, date, name, username) VALUES (?, ?, ?, ?, ?)");

    foreach ($dayIdArray as $dayId) {
        // Check if the dayId starts with "false-" followed by a day
        if (strpos($dayId, 'false-') === 0) {
            // Extract the day from the dayId
            $day = substr($dayId, 6);

            // Set the day to "off" in the pending_shifts table
            $stmt->execute([$uuid, $approved, $date, $name, $username]);
        } else {
            // Fetch the shift information from the shifts table
            $shiftStmt = $pdo->prepare("SELECT * FROM shifts WHERE id = ?");
            $shiftStmt->execute([$dayId]);
            $shiftData = $shiftStmt->fetch(PDO::FETCH_ASSOC);

            // Insert the shift information into the pending_shifts table
            $stmt->execute([$uuid, $approved, $date, $name, $username]);
        }
    }
}

// Example usage
$uuid = 'abc123';
$approved = true;
$date = '2023-05-15';
$name = 'John Doe';
$username = 'johndoe';
$dayIdArray = [1, 2, 'false-3'];

insertPendingShifts($uuid, $approved, $date, $name, $username, $dayIdArray, $pdo);


?>
